<?php

class SavingsController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('*'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','CheckBYDate'),
				'users'=>array('admin'),
			),
           /* array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('CheckBYDate','admin'),
                'users'=>array('admin'),
            ),*/
			/*array('deny',  // deny all users
				'users'=>array('*'),
			),*/

		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{


        if(isset($_POST['savings_history'])){
           $arr=$_POST['savings_history'];

            $arr=array_keys($arr);
           // die(print_r($arr));
            $sql='update '.SavingsHistory::model()->tableName().' set status=1 where savings_id= '.$id.' and term IN('.implode(',',$arr).')';
            $tp=Yii::app()->db->createCommand($sql)->execute();
            //print $tp;die;
        }
        $today=date('Y-m-d');

        $criteria= new CDbCriteria();
        $criteria->select=" *, CASE WHEN pull_date > '".$today."'  THEN 2 ELSE 1   END as pull_able";
        $criteria->condition="  savings_id=".$id;
        //$criteria->condition=" pull_date < '".$today."' AND savings_id=".$id;



            $res=Yii::app()->db->commandBuilder->createFindCommand(SavingsHistory::model()->tableName(),$criteria)->queryAll();


            #print_r($res);die;
        $this->render('view',array(
			'model'=>$res,
		));
	}

    public function actionCheckBYDate(){

        $date=(isset($_GET['date']))?$_GET['date']:date('Y-m-d');
                        $sql=" SELECT
savings_history.pull_date,
savings_history.id,
savings_history.term,
savings.`owner`,
savings.account_number,
savings.`interval`,
savings.amount,
savings.rate,
savings.opend_date,

(savings.rate * savings.amount) as total


FROM
savings
INNER JOIN savings_history ON savings.id = savings_history.savings_id

WHERE savings_history.pull_date <= '$date' and savings_history.`status`!=1 ";
        $data=Yii::app()->db->createCommand($sql)->queryAll();
                         $sql1=" SELECT

sum(savings.rate * savings.amount) as total


FROM
savings
INNER JOIN savings_history ON savings.id = savings_history.savings_id

WHERE savings_history.pull_date <= '$date' and savings_history.`status`!=1 ";
        $data1=Yii::app()->db->createCommand($sql1)->queryRow();


        $total=$data1['total'];

        $arrayDataProvider=new CArrayDataProvider($data, array(
            'id'=>'id',
            /* 'sort'=>array(
                'attributes'=>array(
                    'username', 'email',
                ),
            ), */
            'pagination'=>array(
                'pageSize'=>30,
            ),
        ));
        $this->render('check',array(
            'data'=>$arrayDataProvider,
            'date'=>$date,
            'total'=>$total,
        ));
    }
	public function actionAdd($id)
	{

//$id=10;
        $model=$this->loadModel($id);
        $date=$model->opend_date;
        $period=$model->period;
        $interval=$model->interval;
        $times_per_yr=12/$interval;
        $total=$times_per_yr* $period;

        $next_date=$date;
        for($i=1;$i<=$total;$i++){

            $next_date= date('Y-m-d',strtotime( $next_date.'+'.$interval.' month'));
            $history_model= new SavingsHistory();
            $history_model->savings_id=$id;
            $history_model->term=$i;
            $history_model->pull_date=$next_date;
            $history_model->status=0;
            $history_model->save();

            print $next_date.'<br/>';

        }
        die;
        $this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Savings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Savings']))
		{
			$model->attributes=$_POST['Savings'];
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

		if(isset($_POST['Savings']))
		{
			$model->attributes=$_POST['Savings'];
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
		$dataProvider=new CActiveDataProvider('Savings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Savings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Savings']))
			$model->attributes=$_GET['Savings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Savings the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Savings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Savings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='savings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
