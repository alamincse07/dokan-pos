<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 * @var $L Language
 */
class Controller extends CController
{
    public $assetVersion = "";
    public static $L;
    public static $Config;

    public function init()
    {
        if(!self::$Config){
            self::$Config = new Config();
            self::$L = new Language();
        }

    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();


    public function getActions(){

        if(Yii::app()->session['user_type'] ==1){
            return array('ChartView','view','admin','create','update','delete','add','dokanStock','get','index');
        }
        return array('view','admin', 'index','get');
    }
    public function getAccess($controller='',$action='')
    {
        return array('*');
        if(Yii::app()->session['user_type'] ==1){
            return array('*');
            return array(Yii::app()->session['user']);
        }
        return;
        $menu=false;
//        die("X")
        #return array('*');
        $runtimeRoot = Yii::app()->basePath."/runtime/";
        $permissionJson = $runtimeRoot."group_permission_action.php";
        $userJson = $runtimeRoot."group_permission_list.php";
        if(!file_exists($permissionJson) or !file_exists($userJson)){
            try{
                UserIdentity::generateAccessDataCache();
                UserIdentity::generateGroupPermissionCache();
            }catch (Exception $ex){
                throw new CHttpException(500, "Permission assets are missing! Please reload this page again!");
            }

        }
        if(!Yii::app()->user->isGuest and isset(Yii::app()->session['user_group_id']))
        {
            $user_group_id = Yii::app()->session['user_group_id'];
//            Generic::_setTrace(Yii::app()->user->name);
//            Generic::_setTrace("x2");
            //if(!$menu){$controller = $this->id;$action=$this->action->id;}
            $controller = $this->id;$action=$this->action->id;
            $controller = strtolower($controller);
            $action = strtolower($action);

            //Generic::_setTrace($user_group_id);

            $permissionArray = CJSON::decode(file_get_contents($permissionJson));
            $userArray = CJSON::decode(file_get_contents($userJson));
//            Generic::_setTrace(Yii::app()->session['is_client']);
            $return = array(false);
            $boolReturn = false;
            if(Yii::app()->session['is_client']===true and $controller!="clientdashboard"){
                throw new CHttpException(403,"Admin authentication required");
            }elseif(Yii::app()->session['is_client']<0 and $controller=="clientdashboard"){
                throw new CHttpException(403, "URL only applicable for clients");
            }

//            Generic::_setTrace($controller);
            $groupIds = explode(",",Yii::app()->session['user_group_id']);

            if(!empty($groupIds)){
//                Generic::_setTrace($groupIds);
                foreach($groupIds as $user_group_id){
                    if(
                        $user_group_id>0
                        and
                        isset($permissionArray[$user_group_id][$controller], $userArray[$user_group_id])
                        and
                        (array_search($action,$permissionArray[$user_group_id][$controller])!==false or array_search("*",$permissionArray[$user_group_id][$controller])!==false)
                        and
                        (array_search(Yii::app()->user->name, $userArray[$user_group_id])!==false)
                    ){
                        $return = array(Yii::app()->user->name);
                        $boolReturn=true;
                        break;
                    }
                }

            }
            if($boolReturn and $menu){
                return true;
            }
//            Generic::_setTrace($return);
            return $return;
        }
        elseif($menu)
        {
            return false;
        }

        return array(false);

    }

    public function getUserFullName()
    {
        return (empty(Yii::app()->session['user_full_name']))?Yii::app()->user->name:Yii::app()->session['user_full_name'];
    }
    public function getUserId()
    {
        $id=(isset(Yii::app()->session['portal_client_id']) && Yii::app()->session['portal_client_id']>0)?Yii::app()->session['portal_client_id']:Yii::app()->user->getId();
        //return Yii::app()->user->getId();
        return $id;
    }

    public function getAdvisorRole()
    {
        //return empty(Yii::app()->session['advisor_role'])? 1 : Yii::app()->session['advisor_role'];
        return (isset(Yii::app()->session['super_admin']) && Yii::app()->session['super_admin'] == true)? 1 : 0;
    }

    public function getAdvisorDepartment()
    {
        return empty(Yii::app()->session['advisor_department'])? 1 : Yii::app()->session['advisor_department'];
    }

    public function getAdvisorFunction()
    {
        return empty(Yii::app()->session['advisor_function'])? 1 : Yii::app()->session['advisor_function'];
    }

    public function getUserEmail(){
        return Yii::app()->session['user_data']['email'];
    }
}