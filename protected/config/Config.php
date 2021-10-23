<?php
/**
 * Author: Sabbir
 * Script: DBConfig.php
 */

class Config {

    public $profile_image_path = "uploaded/profile-images/";
    public $file_uploaded_path = "uploaded/documents/";

    public $timeZone = "Asia/Dhaka";

    public $projectName = "Modern Shoe Store ";


    static  $portal_name="";

    public function init(){
        //check and set db for portal
        $_server_name = explode(".",$_SERVER['SERVER_NAME']);
        $portal_list = $this->portalList();
        if(isset($_server_name[0]) and !empty($_server_name[0]) and isset($portal_list[$_server_name[0]])){
            self::$portal_name = $_server_name;
        }

    }

    public function getErrorHandler(){
        return array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        );
    }

    public function getDBConfig()
    {
        return array(
            'connectionString' => 'mysql:host=localhost;dbname=skalamin_dokan',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        );
    }

    public function getLogSetup(){
        return array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
//                    'levels'=>'error, warning',
                    'levels'=>'none',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        );
    }

    public function getParams()
    {
        return array(
            // this is used in contact page
            'adminEmail'=>'webmaster@example.com',
        );
    }

    public function import()
    {
        return array(
            'application.models.*',
            'application.components.*',
        );
    }

    public function userComponent(){
        return array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl'=>array('/site/login/'),

        );
    }

    public function modules(){
        return array(
            // uncomment the following to enable the Gii tool

            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'g',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
            ),
        );
    }

    public function GetAssetManager()
    {
        return array(
//            'linkAssets' => true,
            'linkAssets' => false,
        );
    }


    //registered portal user list
    public function portalList(){
        return [
            ''=>"",
            'test'=>"",
            'www'=>""
        ];
    }

} 