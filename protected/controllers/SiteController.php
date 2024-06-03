<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    public $layout="column2";
    public $defaultAction='login';
   // public $layout="portal";

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        #@TODO:Switch Between Layout and Links for Client and Admin Backend
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

        if(!Yii::app()->user->isGuest){
            $type=User::model()->findByPk(Yii::app()->user->id );
         //  Generic::_setTrace($type->type);
            /*if($type->type!='Client')){

            }*/
            $this->layout="empty-layout";
            if(isset($_REQUEST['old'])){
               
                $this->render('index');
            }else{
                 $this->render('index-new');
            }
           
        }else{
            $this->redirect(array('login'));
        }


    }
    function  actionIndex2(){
        $this->render('index2');


    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        print_r(Yii::app()->errorHandler->error);die;
        $this->layout="simple-portal";
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];}
			elseif(!Yii::app()->user->isGuest){

                $type=User::model()->findByPk(Yii::app()->user->id );
//            Generic::_setTrace($type->type);
                if($type->type!='Client'){
                    $this->layout="sample-admin";
                    $this->render('error', $error);
                    Yii::app()->end();
                }
            }
				//$this->render('error', $error);
            $this->render('error_portal', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
        $L=$this::$L;
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact',$L->g('Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout="sample-admin";
        if(!Yii::app()->user->isGuest){
            /*$type=User::model()->findByPk(Yii::app()->user->id );
            if($type->type=='Client'){
                $status=ClientCalculation::CheckMembershipExpiration($type->id);
                if($status){
                    $count_savings = ClientCalculation::SetInitialClientCookie($type->id);
                }

                //$this->redirect(array('/clientDashboard/dashboard/'.$type->id.'?welcome_popup=true'));
            }*/
            $this->redirect(array('index'));
        }

        $viewName = "backOfficeLogin";



		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
//            Generic::_setTrace($_POST);
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                $splitUrls = explode("/",Yii::app()->user->returnUrl);
                $lastUrl = @$splitUrls[count($splitUrls)-1];

                //$type=User::model()->findByPk(Yii::app()->user->id );




                $this->redirect(Yii::app()->user->returnUrl);
               // $this->redirect('user/dashboard');
            }

            $this->redirect(array('index'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	public function actionDBBackup(){
	
	$this->Backup();
	
	}
	public function Backup(){
	
		
		//ENTER THE RELEVANT INFO BELOW
$mysqlDatabaseName ='dokan';


$mysqlExportPath ='E:/DOKAN-BD-BACKUP/'.date("Y-m-d").".sql";

//DO NOT EDIT BELOW THIS LINE
$mysqlHostName ='localhost';


$correct_command="mysqldump -u root  $mysqlDatabaseName > $mysqlExportPath";

echo "check path variable of mysql and php is set or not";
//echo 'http://localhost/phpmyadmin/db_export.php?db=dokan&server=1&token=324c3c00aa9ee69e13e5ac66056b7777';

$worked=exec($correct_command);

//$worked=exec($command);
switch($worked){
    case 0:
        echo 'Database <b>' .$mysqlDatabaseName .'</b> successfully exported to <b>~/' .$mysqlExportPath .'</b>';
        break;
    case 1:
        echo 'There was a warning during the export of <b>' .$mysqlDatabaseName .'</b> to <b>~/' .$mysqlExportPath .'</b>';
        break;
    case 2:
        echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
        break;
}


	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        $afterLogout = array('/site/login');

		#$this->Backup();
        Yii::app()->user->logout();
        Yii::app()->request->cookies->clear();// remove all cookies after logout
		
		
		//back the db
	
		
		$this->redirect($afterLogout);
	}
    public function actionRegister()
    {
        $this->render('Register');
    }
    public function actionForgotPassword()
    {
        $L=$this::$L;
        $this->layout="simple-portal";

        $message='';
        if(isset($_POST['email']) && $_POST['email']!='')
        {
            $recoveryEmail=Yii::app()->request->getParam('email');
            $user_model=User::model()->findByAttributes(array('email'=>$recoveryEmail));
            if($user_model){
                $code=sha1($recoveryEmail.'-portal');
                $newPassword=rand(1000,5000);

                $message="Your New Password: ".$newPassword."<br/>You activation link is:".$this->createUrl('site/PasswordRecovery')."?token=$code";

                $sql="INSERT INTO client_forgot_password (token,password,recovery_email) VALUES ('$code','$newPassword','$recoveryEmail')";
                $forgotPassword=Yii::app()->db->createCommand($sql)->execute();
                if($forgotPassword){
                   if(XSendMail::sendMail('Password Recovery','admin@mijnkees.com',$recoveryEmail,$message)==true){
                        Generic::_setTrace('Successfully Mail Sent');
                    }
                   else{
                       $message= 'Mail Not Sent';
                   }
                }
                else{
                    $message= 'Error Occurs';
                }

            }
            else{
                $message='No user exist with this email id';
               /* $L=$this::$L;
                Yii::app()->user->setFlash("Success", $L->g("No User With This Email Id."));*/
            }
        }
        $this->render('forgotPassword',array('message'=>$message));
    }

    //file upload/
    public function actionUploadMultiple(){
        /**
        * @var $Config Config
         */
        $L=$this::$L;
        $model = new User;
        if(Yii::app()->request->isPostRequest){
//            throw new CHttpException(500);
            $Config = new Config();
            $uploaded_file = CUploadedFile::getInstance($model,'avatar');
            $main_image=null;
            if($uploaded_file)
            {
                $main_image =str_replace(".".$uploaded_file->getExtensionName(),"-",$uploaded_file->getName())
                    .time().".".$uploaded_file->getExtensionName();
                $model->avatar=$uploaded_file;#initialize model attribute with file name
                $model->avatar->saveAs($Config->profile_image_path.$main_image);//this will upload selected image file
                print $L->g('Success');
            }
            Yii::app()->end();
        }

        $this->render('multipleUpload', array('model'=>$model));
    }


    /**
     * Displays the login page
     */
    public function actionBackOfficeLogin()
    {
        Generic::_setTrace(Yii::app()->user->returnUrl);
        if(!Yii::app()->user->isGuest){
            Yii::app()->request->redirect($this->createUrl("/admin/"));
            $type=User::model()->findByPk(Yii::app()->user->id );
            if($type->type=='Client'){
                $this->redirect('user/dashboard');
            }
            $this->redirect(array('/admin'));
        }

        $this->layout="sample-admin";

        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
//           Generic::_setTrace($_POST);
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login()){
                // $this->redirect(Yii::app()->user->returnUrl);
                $type=User::model()->findByPk(Yii::app()->user->id );
                if($type->type=='Client'){
                    $this->redirect('user/dashboard');
                }
                else{
                    $this->redirect(array('/admin'));
                }

            }

        }
        // display the login form
        $this->render('backOfficeLogin',array('model'=>$model));
    }

    public function actionPasswordRecovery(){

        $token=Yii::app()->request->getParam('token');
        $new_password_sql="SELECT recovery_email,password from client_forgot_password where token='$token' AND status=0";
        $result_forgot_password=Yii::app()->db->createCommand($new_password_sql)->queryRow();

        if($result_forgot_password){

            $user_model_result=User::model()->findByAttributes(array('email'=>$result_forgot_password['recovery_email']));
            if($user_model_result){
                $user_model_result->password=sha1($result_forgot_password['password']);
                $user_model_result->update();
                $this->redirect(array('site/login'));
            }

        }

     }

}