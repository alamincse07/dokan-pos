<?php

class AccessController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/admin';
    public $layout='admin-layout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		##parent::filters();
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

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array($this->action->id),
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
        $this->redirect('update/'.$id);
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
		$model=new Access;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Access']))
		{
			$model->attributes=$_POST['Access'];
			if($model->save()):
                if(isset($_POST['CustomFieldValue'])){
                    $data = $_POST['CustomFieldValue'];
                    Generic::setCustomFieldData($data, $model->id);
                }
                UserIdentity::generateAccessDataCache(true);
                UserIdentity::generateGroupPermissionCache(true);
				$this->redirect(array('view','id'=>$model->id));
            endif;
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

		if(isset($_POST['Access']))
		{
			$model->attributes=$_POST['Access'];
			if($model->save()):
                if(isset($_POST['CustomFieldValue'])){
                    $data = $_POST['CustomFieldValue'];
                    GenericProperties::setCustomFieldData($data, $model->id);
                }

                UserIdentity::generateAccessDataCache(true);
                UserIdentity::generateGroupPermissionCache(true);
				$this->redirect(array('view','id'=>$model->id));
            endif;
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

        UserIdentity::generateAccessDataCache(true);
        UserIdentity::generateGroupPermissionCache(true);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->redirect('admin');
		$dataProvider=new CActiveDataProvider('Access');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Access('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Access']))
			$model->attributes=$_GET['Access'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Access the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        /**
         * @var $L Language
         */
        $L = self::$L;
        $model=Access::model()->findByPk($id);
		if($model===null)
            throw new CHttpException(404,$L->g('The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Access $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='access-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


}
