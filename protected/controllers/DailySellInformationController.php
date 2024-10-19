<?php

class DailySellInformationController extends Controller
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
          //  'accessControl', // perform access control for CRUD operations
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

    public function actionChartView()
    {
        $this->render('chart',array(
          //  'model'=>$this->loadModel($id),
        ));
    }

    public function actionChartViewWeekly()
    {
        $this->render('weekly',array(
          //  'model'=>$this->loadModel($id),
        ));
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DailySellInformation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DailySellInformation']))
		{
			$model->attributes=$_POST['DailySellInformation'];
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DailySellInformation']))
		{
			$model->attributes=$_POST['DailySellInformation'];
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DailySellInformation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DailySellInformation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DailySellInformation']))
			$model->attributes=$_GET['DailySellInformation'];

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
		$model=DailySellInformation::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='daily-sell-information-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionDokanStock(){

        $result_div='';
        $which_result_div='';


        if(isset($_POST['all_stock_info'])){

            $which_result_div='Total Stock Information';
            $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles`; ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>';

        }
        if(isset($_POST['stock_article'])){

            $which_result_div=' Stock Information of '.$_POST['stock_article'];
            $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles` where article like '".addslashes($_POST['stock_article'])."'";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>';

        }

        if(isset($_POST['category_stock'])){

            $which_result_div=' Stock Information of '.$_POST['category_stock'];
            $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles` where  category like '".addslashes($_POST['category_stock'])."'; ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>';

        }
        if(isset($_POST['profit_single_date'])){

            $which_result_div=' Daily Information of '.$_POST['profit_single_date'];
            $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE date(date) like '".addslashes($_POST['profit_single_date'])."' ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

        }
        if(isset($_POST['profit_start_day'],$_POST['profit_start_day'])){

            $which_result_div=' Date Information of '.$_POST['profit_start_day'].' to '.$_POST['profit_end_day'];
            $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE date(date) between '".addslashes($_POST['profit_start_day'])."'  AND '".addslashes($_POST['profit_end_day'])."'  ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

        }
        if(isset($_POST['profit_with_category'],$_POST['profit_with_category_start_day'],$_POST['profit_with_category_end_day'])){

            $which_result_div=' Profit  of '.$_POST['profit_with_category'].' from '.$_POST['profit_with_category_start_day'].' to '.$_POST['profit_with_category_end_day'];
            $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE category like '".addslashes($_POST['profit_with_category'])."' AND date(date) between '".addslashes($_POST['profit_with_category_start_day'])."'  AND '".addslashes($_POST['profit_with_category_end_day'])."'  ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

        }
        if(isset($_POST['tags'],$_POST['all_tag_stock'])){

            $tags = $_POST['tags'];
            $tags = array_filter($tags);
            $json = json_encode($tags, JSON_UNESCAPED_UNICODE);
            $tags_sql = "SELECT
                            count(total_pair)  as total
                        FROM
                            articles 
                        WHERE
                            JSON_CONTAINS( tags, '$json' )";

            $which_result_div=' Stock info of   '.implode(',',$_POST['tags']);
            
            $res= Yii::app()->db->createCommand($tags_sql);
            $data = $res->queryRow();
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['total'].'
                    
                    </div>';
        }

         
        

        if(isset($_POST['tags'],$_POST['baring_cost_start_day'],$_POST['baring_cost_end_day'])){

            $tags = $_POST['tags'];
            $tags = array_filter($tags);
            $json = json_encode($tags, JSON_UNESCAPED_UNICODE);
            $tags_sql = "SELECT
                            article 
                        FROM
                            articles 
                        WHERE
                            JSON_CONTAINS( tags, '$json' )";
            $which_result_div=' Sell info of   '.implode(',',$_POST['tags'])." from ".$_POST['baring_cost_start_day'].' to '.$_POST['baring_cost_end_day'];
            //$q= "SELECT  SUM(amount) as taka   FROM `daily_cost_items` WHERE cost_type like ' Bearing Cost' AND date(date) between '".addslashes($_POST['baring_cost_start_day'])."'  AND '".addslashes($_POST['baring_cost_end_day'])."'  ";
            $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE article IN ($tags_sql) AND date(date) between '".addslashes($_POST['baring_cost_start_day'])."'  AND '".addslashes($_POST['baring_cost_end_day'])."'  ";
            // die($q);
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';
        }

        if(isset($_POST['profit_start_day'],$_POST['profit_start_day'])){

            $which_result_div=' Date Information of '.$_POST['profit_start_day'].' to '.$_POST['profit_end_day'];
            $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE date(date) between '".addslashes($_POST['profit_start_day'])."'  AND '".addslashes($_POST['profit_end_day'])."'  ";
            $res= Yii::app()->db->createCommand($q);
            $data = $res->queryRow();
            //$all_sells_man_name='';
            $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

        }

        $data = array(
            'which_result_div'=>$which_result_div,
            'result_div'=>$result_div,
        );

        if (Yii::app()->request->isPostRequest) {
            die(json_encode( $data )  );
        }

        $this->render('info', $data);
    }
}
