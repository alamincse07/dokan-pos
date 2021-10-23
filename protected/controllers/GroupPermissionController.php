<?php

class GroupPermissionController extends Controller
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
		#parent::filters();
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
       $this->redirect(array('update','id'=>$id));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GroupPermission;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GroupPermission']))
		{
			$model->attributes=$_POST['GroupPermission'];
            $model->action = strtolower($model->action);
            $model->controller = strtolower($model->controller);

            if($model->controller=='all'){
                $total_controllers=Enum::getControllers();
                $controllers = array_shift($total_controllers);
                foreach($total_controllers as $key=>$value){
                    $model=new GroupPermission;
                    $model->attributes=$_POST['GroupPermission'];
                    $model->action = strtolower($model->action);
                    $model->controller = strtolower($key);
                    if($model->save()):
                        if(isset($_POST['CustomFieldValue'])){
                            $data = $_POST['CustomFieldValue'];
                            GenericProperties::setCustomFieldData($data, $model->id);
                        }
                        UserIdentity::generateAccessDataCache(true);
                        UserIdentity::generateGroupPermissionCache(true);
                    endif ;
                }
                $this->redirect(array('view','id'=>$model->id));
            }
            else{
                $model->attributes=$_POST['GroupPermission'];
                $model->action = strtolower($model->action);
                $model->controller = strtolower($model->controller);
                if($model->save()):
                    if(isset($_POST['CustomFieldValue'])){
                        $data = $_POST['CustomFieldValue'];
                        GenericProperties::setCustomFieldData($data, $model->id);
                    }
                    UserIdentity::generateAccessDataCache(true);
                    UserIdentity::generateGroupPermissionCache(true);

                    $this->redirect(array('view','id'=>$model->id));
                endif ;
            }

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

		if(isset($_POST['GroupPermission']))
		{
			$model->attributes=$_POST['GroupPermission'];
            $model->action = strtolower($model->action);
            $model->controller = strtolower($model->controller);
			if($model->save()):
                if(isset($_POST['CustomFieldValue'])){
                    $data = $_POST['CustomFieldValue'];
                    GenericProperties::setCustomFieldData($data, $model->id);
                }
                UserIdentity::generateAccessDataCache(true);
                UserIdentity::generateGroupPermissionCache(true);
				$this->redirect(array('view','id'=>$model->id));
            endif ;
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
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new GroupPermission('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GroupPermission']))
			$model->attributes=$_GET['GroupPermission'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GroupPermission the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        $L=$this::$L;
		$model=GroupPermission::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,$L->g('The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GroupPermission $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='group-permission-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
