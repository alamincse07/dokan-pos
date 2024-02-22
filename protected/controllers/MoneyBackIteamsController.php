<?php

class MoneyBackIteamsController extends Controller
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
		$model=new MoneyBackIteams;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MoneyBackIteams']))
		{
			$model->attributes=$_POST['MoneyBackIteams'];
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

		if(isset($_POST['MoneyBackIteams']))
		{
			$model->attributes=$_POST['MoneyBackIteams'];
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
		$dataProvider=new CActiveDataProvider('MoneyBackIteams');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MoneyBackIteams('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MoneyBackIteams']))
			$model->attributes=$_GET['MoneyBackIteams'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdd(){
        $list = ["12135","12135","2443","10128","10128","10128","12179","18128","11905","2453","2453","39176","39176","3274","12172","1003","3630","4335","4335","4335","39126","39181","39181","4958","10342","10342","10356","4955","0987","4809","4809","4809","4829","8401","5295","6658","50138","95171","95140","8725"];
        foreach ($list as $article) {
            $up_q="update articles set total_pair=total_pair+1 , total_taka= total_taka+actual_price  where  upper(article)='$article' ";
            print($up_q);
            $res=Yii::app()->db->createCommand($up_q)->execute();
            
        }

 }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=MoneyBackIteams::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='money-back-iteams-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
