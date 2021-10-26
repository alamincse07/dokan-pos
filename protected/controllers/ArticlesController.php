<?php

class ArticlesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/simple-portal';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        //die($this->action->id);
        return array(

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>$this->getAction(),
                'actions'=>$this->getActions(),
                'users'=>$this->getAccess(),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Articles;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionIndex(){

        
        if(isset($_REQUEST['cat'])){
            $where=" where category like '".$_REQUEST['cat']."'";
            $selected=strtoupper($_REQUEST['cat']);
        }else{
            $where=" ";
            $selected='';

        }
       // $where=" ";
        $ar_q= "SELECT DISTINCT(article) FROM articles ".$where."  ";
        //DIE($ar_q);
        $res_all= Yii::app()->db->createCommand($ar_q)->queryAll();
        //$res_all = $res_ar_q->fetch_all(MYSQLI_ASSOC);
        $all_articles='';
        //die(print_r($sells_mana));
        foreach($res_all as $k=>$val){
        //print $val['member_name'];
            $all_articles.='<option value="'.$val['article'].'">'.$val['article'].'</option>';
        }
        $html='<select style="min-width: 220px; float: right;" id="common_article" name="stock_article"  size="1">

                    '.$all_articles.'

                </select>';

        die(json_encode(['options'=>$html]));
    }
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
            $model->attributes=$_POST['Articles'];
            
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex1()
	{
		$dataProvider=new CActiveDataProvider('Articles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Articles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Articles']))
			$model->attributes=$_GET['Articles'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{

		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    public function actionAdd()
    {

       
        $msg ='';
        $db= Yii::app()->db;
        if(isset($_POST['stock_article__sexyCombo'])){
            // die(print_r($_POST));//
            if(isset($_POST['stock_article__sexyCombo']) && $_POST['stock_article__sexyCombo']=='' ){
                $msg='Please Give Article';

            }
            elseif(isset($_POST['article_pair']) && $_POST['article_pair']=='' ){
                $msg='মোট জোড়া দিন';

            }
			elseif(strtoupper($_REQUEST['category_stock'])=='VRC'){
				 if(   (isset($_POST['article_total_taka']) && $_POST['article_total_taka']=='')  && (isset($_POST['article_actual_rate']) && $_POST['article_actual_rate']=='')   ){
	                $msg='মোট কেনাদাম দিন';

	            }else{
				$msg='ok';
				}
				
				
			 }
            
            elseif(isset($_POST['article_body_rate']) && $_POST['article_body_rate']=='' && strtoupper($_REQUEST['category_stock'])=='DSR'){
                $msg='বডিরেট দিন';
            }
            elseif(isset($_POST['article_body_rate']) && $_POST['article_body_rate']=='' && strtoupper($_REQUEST['category_stock'])=='BATA'){
                $msg='বডিরেট দিন';
            }
            elseif(isset($_POST['article_body_rate']) && $_POST['article_body_rate']=='' && strtoupper($_REQUEST['category_stock'])=='APEX'){
                $msg='বডিরেট দিন';
            }
            elseif(isset($_POST['percentage']) && $_POST['percentage']=='' && (strtoupper($_REQUEST['category_stock'])=='BATA' || strtoupper($_REQUEST['category_stock'])=='APEX' )){
                $msg='কমিশন %  দিন';
            }
            else{
                $msg='ok';
            }


            if($msg=='ok'){
                //insert


                $article=  addslashes(trim(strtoupper($_REQUEST['stock_article__sexyCombo'])));
                $category =  addslashes(trim(strtoupper($_REQUEST['category_stock'])));
                $pair =  addslashes(trim(strtoupper($_REQUEST['article_pair'])));
               // $orginal_article =  addslashes(trim(strtoupper($_REQUEST['orginal_article'])));
				$orginal_article =  'n/a';


                if(strtoupper($category=='JSR')){
                    $percentage=0.18;
                    $body_rate =  addslashes(trim(strtoupper($_REQUEST['article_body_rate'])));


                    $actual_rate = $body_rate-(intval(ceil($body_rate*$percentage)));

                    $total_taka = $actual_rate*$pair;


                }
                elseif(strtoupper($category=='DSR')){
                    $percentage=0.28;

                    $body_rate =  addslashes(trim(strtoupper($_REQUEST['article_body_rate'])));


                    $actual_rate = $body_rate-(intval(ceil($body_rate*$percentage)));

                    $total_taka = $actual_rate*$pair;

                    IF(isset($_POST['article_body_rate']) && $_POST['article_body_rate']==''){
                        $msg='Please Give body rate';
                    }
                }
                elseif(strtoupper($category=='BATA') || strtoupper($category=='APEX')  || strtoupper($category=='PEGA') || strtoupper($category=='LOTTO')){
                    $percentage= (($_POST['percentage']*1) / 100);
                    //Generic::_setTrace($_POST,false);
                   // Generic::_setTrace($percentage);
                    $body_rate =  addslashes(trim(strtoupper($_REQUEST['article_body_rate'])));


                    $actual_rate = $body_rate -(intval(ceil($body_rate*$percentage)));

                    $total_taka = $actual_rate*$pair;

                    IF(isset($_POST['article_body_rate']) && $_POST['article_body_rate']==''){
                        $msg='Please Give body rate';
                    }
                }
                
                else{
                    $total_taka =  addslashes(trim(strtoupper(@$_REQUEST['article_total_taka'])));
                    $actual_rate =  addslashes(trim(strtoupper(@$_REQUEST['article_actual_rate'])));
                    $body_rate =  addslashes(trim(strtoupper(@$_REQUEST['article_body_rate'])));

                    if($actual_rate!='' && $actual_rate*1 > 0){

					   $total_taka=$actual_rate * $pair;
					
                    }else{
                        if(is_numeric($total_taka)){

                            $actual_rate= intval(ceil($total_taka/$pair));
                        }else{
                            $actual_rate= 0;
                            $msg='মোট কেনাদাম দিন';
                        }
                        
                    }
                }

                //$body_rate =  addslashes(trim(strtoupper($_REQUEST['article_body_rate'])));


                if(isset($actual_rate) && $actual_rate!='' && $actual_rate>0){
                    $upacp=" ,increment=$actual_rate-actual_price, actual_price= IF(actual_price<$actual_rate,$actual_rate,actual_price)";
                }else{
                    $upacp='';
                }
                $body_rate = intval($body_rate) *1;
                $sql=" Insert into articles set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update body_rate=$body_rate , total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka".$upacp.";";
                $sql2=" Insert into last_added_items set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update  total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka;";

                $res=0;
                if($msg=='ok'){

                 $time=date('H');
				 $time2=$time.intval((date('i') / 10));
				// file_put_contents("article-$time2.txt","\n\r".$sql,FILE_APPEND);
				 // file_put_contents("last-added-$time2.txt","\n\r".$sql2,FILE_APPEND);
                 $res= Yii::app()->db->createCommand($sql2)->execute();
                 $res= Yii::app()->db->createCommand($sql)->execute();

                
                // $res=1;
                }



                 #die($sql);
			
                if($res){
                    //header("Location:http://localhost/dokan/options/article_add.php?category=".$category."&date=".$today);
                    //header("Location:http://localhost/dokan/options/article_add.php?category=".$category."&date=".$today);
                    $msg='added';
                    $_REQUEST['actual_rate'] = '';
                    if($category=='VRC' || $category=='INDIAN'){
                        $_REQUEST['actual_rate'] = $actual_rate;
                    }
                    
                }else{
                 //   $msg=trim("Error happens".$sql);
                }



            }else{
                // show message
            }


        }


		if(Yii::app()->request->isAjaxRequest){
		
		die(json_encode(['status'=>$msg,'info'=>$_REQUEST]));
		}

        $this->render('add',array(
            'msg'=>$msg,
        ));
    }
}
