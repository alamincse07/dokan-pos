<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;


    public function getId()
    {
        return $this->_id;
    }

    //show list of users order by group id
    public static function generateAccessDataCache($force=false)
    {
        $root_directory=Yii::app()->getBasePath();
        $runtime="/runtime/group_permission_list.php";
        $filename=$root_directory.$runtime;

        if (!file_exists($filename) or $force===true)
        {
            $criteria=new CDbCriteria();
            $criteria->select="t2.group_id,t.username";
            $criteria->join="INNER JOIN ".Access::model()->tableName()." t2 ON t.id=t2.user_id";
            $criteria->order="group_id";
            $accessData=Yii::app()->db->commandBuilder->createFindCommand(User::model()->tableName(),$criteria)->queryAll();
            $user_list=[];
            #GenericProperties::_setTrace($accessData,$die=true);
            foreach ($accessData as $data)
            {
                $user_list[$data['group_id']][] = $data['username'];
            }
            #GenericProperties::_setTrace($user_list,$die=true);
            $users_access=CJSON::encode($user_list);
            file_put_contents($filename, $users_access);
        }
    }

    //show access of controller order by group_id
    public static function generateGroupPermissionCache($force=false)
    {
        $root_directory=Yii::app()->getBasePath();
        $runtime="/runtime/group_permission_action.php";
        $filename=$root_directory.$runtime;
        if(!file_exists($filename) or $force===true)
        {
            $criteria=new CDbCriteria();
            $criteria->select="controller,action,group_id";
            $criteria->order="group_id,controller";
            $permissionData=Yii::app()->db->commandBuilder->createFindCommand(GroupPermission::model()->tableName(),$criteria)->queryAll();
            $permission_list=[];
            #GenericProperties::_setTrace($permissionData,$die=true);
            foreach($permissionData as $data)
            {
                $permission_list[$data['group_id']][$data['controller']][]=$data['action'];
            }

            #GenericProperties::_setTrace($permission_list,$die=true);
            $controller_permission=CJSON::encode($permission_list);
            file_put_contents($filename,$controller_permission);
        }

    }



    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $model = new Member();

        $model = $model->find('member_name=:username
        AND member_password=:password',
            array(
                ':username'=>$this->username,
                ':password'=>($this->password),
            ));

        if($model)
        {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $model->id;

            Yii::app()->session['user_full_name'] = $model->member_name;
            Yii::app()->session['user'] = $model->member_name;
            Yii::app()->session['user_type'] = $model->member_type;
        }
        else
        {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }
//        print $this->_id;exit;
        return !$this->errorCode;
    }


    /*public function authenticate()
    {
        $model = new User();

        $model = $model->find('username=:username
        AND password=:password
        AND active=:active',
            array(
                ':username'=>$this->username,
                ':password'=>sha1($this->password),
                ':active'=>1
            ));

        if(isset($model->username) and $model->username==$this->username)
        {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $model->id;
            Yii::app()->session['user_full_name'] = $model->full_name;
            //Yii::app()->session['nameof'] = 'yes';
            #GenericProperties::setAffiliateId();
            GenericProperties::setUserImage($model->avatar,$model->id,true);

            $criteria=new CDbCriteria();
            $criteria->select="group_id";
            $criteria->compare("user_id", $this->_id);
            $groupIdQuery=Yii::app()->db->commandBuilder->createFindCommand(Access::model()->tableName(),$criteria)->query();
            $groupIdS = array();
            if($groupIdQuery){

                while($groupId = $groupIdQuery->read()){
                    $groupIdS[] = $groupId['group_id'];
                }
            }

            if(!empty($groupIdS)){
                Yii::app()->session['user_group_id'] = implode(",",$groupIdS);
            }

            GenericProperties::setAffiliateId();#30-01-14
            //self::generateAccessDataCache();        //show list of users order by group id
            //self::generateGroupPermissionCache();  //show access of controller order by controller

        }
        else
        {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        }

        return !$this->errorCode;
    }*/
}