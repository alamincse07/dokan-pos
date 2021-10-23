<?php

class UserController extends Controller
{
    public $layout="admin-layout";

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
/*
        die($this->action->id);*/
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				#'actions'=>array('admin','delete','update','create'),
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
        $Config = new Config();
		$model=new User;

        $image_path = Yii::app()->basePath."/../".$Config->profile_image_path;
		// Uncomment the following line if AJAX validation is needed
//		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

            if($model->password!="")
            {
                $model->password = sha1($model->password);
            }

#Avatar Upload#


            $uploaded_file = CUploadedFile::getInstance($model,'avatar');

            $main_image=null;
            if($uploaded_file and $model->validate())
            {
                $main_image =time()."-".$model->username.".".$uploaded_file->getExtensionName();

                $model->avatar=$uploaded_file;#initialize model attribute with file name

                $model->avatar->saveAs($image_path.$main_image);//this will upload selected image file
                $model->avatar = $main_image;

            }
#Avatar Upload#


			if($model->save()):
                Generic::setUserImage($main_image,$model->getPrimaryKey());
                UserIdentity::generateAccessDataCache(true);
				$this->redirect(array('view','id'=>$model->id));
            endif;
		}

        $model->password = null;

        if(isset($model->avatar)){$model->avatar=null;}
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
        $Config = new Config();
        $image_path = Yii::app()->basePath."/../".$Config->profile_image_path;

        $model=$this->loadModel($id);
        $password = $model->password;
        $old_image = $model->avatar;
		// Uncomment the following line if AJAX validation is needed
//		 $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            if($model->password!="")
            {
                $model->password = sha1($model->password);
            }
            else
            {
                $model->password = $password;
            }

#Avatar Upload#

            $uploaded_file = CUploadedFile::getInstance($model,'avatar');

            if($uploaded_file and $model->validate())
            {
                $main_image =time()."-".$model->username.".".$uploaded_file->getExtensionName();

                $model->avatar=$uploaded_file;#initialize model attribute with file name

                $model->avatar->saveAs($image_path.$main_image);//this will upload selected image file
                $model->avatar = $main_image;

                Generic::setUserImage($main_image,$model->id);
                if($old_image)://if image uploaded then delete old uploaded image
                    @unlink($image_path.$old_image);#if new image uploaded then delete previous image
                endif;
            }
#Avatar Upload#

			if($model->save()):
                UserIdentity::generateAccessDataCache(true);
				$this->redirect(array('view','id'=>$model->id));
            endif ;
		}
        $model->password = null;
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
        $model = $this->loadModel($id);
        $old_image = $model->avatar;
        $model->delete();
        UserIdentity::generateAccessDataCache(true);
        if($old_image!=null){
            @unlink(Yii::app()->basePath."/../images/profile-images/".$old_image);#if new image uploaded then delete previous image
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
       // $this->layout="admin-layout";
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        $L=$this::$L;
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,$L->g('The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionMyAccount(){
        $this->render('myAccount');
    }
    public function actionDashboard(){

        $this->render('dashboard');
    }
    public function actionMyInsurance(){
        $this->render('myInsurance');
    }
    public function actionMyMortgage(){
        $this->render('myMortgage');
    }
    public function actionMyRetirement(){
        $this->render('myRetirement');
    }

    public function actionMyCredit(){
        $this->render('myCredit');
    }

    public function actionMyBoss(){
        $this->render('myBoss');
    }

    public function actionMyActions(){
        $this->render('myActions');
    }
    public function actionMyOpinion(){
        $this->render('myOpinion');
    }

    public function actionMyDamage(){
        $this->render('myDamage');
    }
    public function actionMyAdvisors(){
        $this->render('myAdvisors');
    }
    public function actionHelp(){
        $this->render('Help');
    }
    public function actionDirectSave(){
        $this->render('directSave');
    }

    //super admin settings
    public function actionSuperAdminSettings($id)
    {
        $L = self::$L;
        $controller=Yii::app()->controller->id;

        $user_model=$this->loadModel($id);

        $old_password=$user_model->password;
        //Generic::_setTrace($old_password,false);
        if(isset($_POST['User']))
        {
            //Generic::_setTrace($_POST);
            try{
                $user_model->attributes=$_POST['User'];

                $userId=0;

                //$user_model->username = $_POST['User']['email'];
                $user_model->type = 'SuperAdmin';

                if($_POST['User']['password'] !='') {
                    $user_model->password = ($_POST['User']['password']);
                    $user_model->repeat_password = ($_POST['User']['password']);
                    $user_model->setScenario('updatePassword'); // *** THIS activates the validations for the passwords ***
                    // Generic::_setTrace($user_model);
                }
                if($user_model->validate()){

                    $main_image=$user_model->avatar;

                    $avatar_file = CUploadedFile::getInstance($user_model,'avatar');

                    if($avatar_file)
                    {
                        $Config = new Config();
                        $main_image =time()."-".$user_model->username.".".$avatar_file->getExtensionName();
                        $image_path = Yii::app()->basePath."/../".$Config->profile_image_path;
                        $user_model->avatar=$avatar_file;#initialize model attribute with file name

                        $user_model->avatar->saveAs($image_path.$main_image);//this will upload selected image file
                        $user_model->avatar = $main_image;
                    }

                    if($user_model->password!=''){
                        $user_model->password =sha1($_POST['User']['password']);
                        $user_model->repeat_password = sha1($_POST['User']['password']);

                    }else{
                        $user_model->password = $old_password;
                        $user_model->repeat_password = $old_password;
                    }
                    if($user_model->save(false)){
                        $userId = $user_model->id;
                        if($userId>0){

                            UserIdentity::generateAccessDataCache(true);
                            $L=$this::$L;
                            Yii::app()->user->setFlash("success", $L->g("Information saved successfully."));
                            $this->redirect(array('/site/logout'));
                        }
                    }

                }

            }
            catch(CException $e){
                throw new CHttpException(500, $e->getMessage());
            }

        }
        $user_model->password = '';
        $this->render('_superAdminSettings',array(
            'user_model'=>$user_model
        ));
    }

}
