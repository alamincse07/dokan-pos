<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 7/7/14
 * Time: 1:04 PM
 */

class XModel extends CActiveRecord{

    public static $L;

    public function init(){

        if(!self::$L){
            self::$L = new Language();
        }
    }
    /**
     * add default attributes value if not found
     * @return bool|void
     */
    public function afterValidate()
    {
        //Generic::_setTrace($this);
        if($this->isNewRecord){//if insert request

            if(isset($this->advisor_id)){
               if($this->advisor_id!=''){
               }else{
                   $this->advisor_id=1;
               }
            }

           // if(isset($this->create_date) and $this->create_date==''){
                $this->create_date = date("Y-m-d H:i:s");
                $this->update_date = date("Y-m-d H:i:s");
           // }
           /* if(isset($this->created_by)
                and $this->created_by==''
                and (Yii::app()->user->getId()>0)){*/
                $this->created_by = Yii::app()->user->getId();
                $this->update_by = Yii::app()->user->getId();
           // }
        }elseif(

            isset($this->id) and $this->id!=''){//if update request


            if(isset($this->create_date) and $this->create_date==""){unset($this->create_date);}
           // if(isset($this->update_date) and $this->update_date==''){
                $this->update_date = date("Y-m-d H:i:s");
           // }
            /*if(isset($this->updated_by)
                and $this->updated_by==''
                and (Yii::app()->user->getId()>0)){*/
                $this->update_by = Yii::app()->user->getId();
           // }
        }

        if(isset($this->inactive) and $this->inactive==''){//if inactive attributes found and its null
            $this->inactive = 0;
        }

        //Generic::_setTrace($this->attributes);
        return parent::afterValidate();
        //throw new ErrorException("before validate not worked for this change", 500);
    }



} 