<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $create_date
 * @property string $update_date
 * @property integer $avatar
 * @property integer $telephone_number
 * @property string prefix
 * @property string $type
 * The followings are the available model relations:
 * @property Access[] $accesses
 */
class User extends XModel
{
    public $full_name;
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

    public $repeat_password;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.

		return array(
            //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			//array('username', 'required'),

			array('first_name,last_name,email,password', 'required', 'on'=>'insert'),
            array('email','email'),
            array('type', 'length', 'max'=>10),
            array('username,email','unique'),
            array('username','length', 'max'=>50),
            array('prefix','length', 'max'=>5),
            array('password, repeat_password','length', 'max'=>100),
            array('password', 'compare', 'compareAttribute'=>'repeat_password','operator'=>'=='),
            array('password', 'length', 'min'=>6,'message'=>'Password must at least 6 characters long','on'=>'insert, updatePassword'),
            array('password','match','pattern'=>'/\d/', 'message'=>'Password must contain at least one Numeric digit.','on'=>'insert, updatePassword'),
            array('password','match','pattern'=>'/(?=.*[A-Z])/', 'message'=>'Password must contain at least one Capital letter.','on'=>'insert, updatePassword'),

            array('first_name, last_name, email','length', 'max'=>120),
            array('validator','length', 'max'=>512),
            array('avatar','file','allowEmpty'=>true,'types'=>'jpg, png, gif, jpeg'),
			array('create_date, update_date,telephone_number,repeat_password', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password,prefix, email, create_date, update_date, first_name, last_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'accesses' => array(self::HAS_MANY, 'Access', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        /**
         * @var $L Language
         */
        $L = self::$L;
		return array(
			'id' => $L->g('ID'),
			'username' => $L->g('Username'),
			'password' => $L->g('Password'),
			'repeat_password' => $L->g('Repeat Password'),
			'prefix' => $L->g('Prefix'),
			'email' => $L->g('Email'),
			'avatar' => $L->g('Photo'),
			'telephone_number' => $L->g('Telephone Number'),
			'create_date' => $L->g('Create Date'),
			'update_date' => $L->g('Update Date'),
            'first_name'=>$L->g('First Name'),
            'last_name'=>$L->g('Last Name')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		#$criteria->compare('username',strtolower($this->username),true);
        $criteria->addSearchCondition('username', $this->username, true, 'AND', 'LIKE');
		$criteria->compare('password',$this->password,true);
		#$criteria->compare('full_name',$this->full_name,true);
        $criteria->addSearchCondition('first_name', $this->full_name, true, 'AND', 'LIKE');
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone_number',$this->telephone_number,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		//$criteria->compare('is_active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /*public function beforeValidate()
    {
        if(!$this->isNewRecord)
        {
            $this->password = $this->password;
        }
        return parent::beforeValidate();
    }*/

    public function afterValidate()
    {
        if($this->isNewRecord)
        {
            $this->create_date = date("Y-m-d H:i:s");
        }
        $this->update_date = date("Y-m-d H:i:s");

        #$this->password = sha1($this->password);


        return parent::afterValidate();
    }

    public function getUserComboService($active=1)#changed here #active=true
    {
        //return CHtml::listData($this->findAll("is_active=:active",array(':active'=>$active)),'id','username');
        return CHtml::listData($this->findAll(),'id','username');
    }

    public function getUserData($id)
    {
        return $this->findByPk($id);
    }

    public function getActiveText($model)
    {
        if( isset($model->active) ) {
            $array = Enum::yesNo();
            return $array[$model->active];
        } else {
            return 'N/A';
        }
    }
    #30-01-14
    public function getUserNames($user_id,$active=1){
        return CHtml::listData($this->findAll("is_active=:active AND id!=:id",array(':active'=>$active,':id'=>$user_id)),'id','username');
    }
    #30-01-14


    //add directory for new user
    public function afterSave()
    {
        $Config = new Config();
        $path=Yii::app()->basePath."/../".$Config->file_uploaded_path.$this->id;

        if(!file_exists($path)){
            mkdir($path, 0755, true);
        }

        return parent::afterSave();
    }

}
