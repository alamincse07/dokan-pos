<?php

/**
 * This is the model class for table "tbl_access".
 *
 * The followings are the available columns in table 'tbl_access':
 * @property integer $id
 * @property integer $user_id
 * @property integer $group_id
 *
 * The followings are the available model relations:
 * @property UserGroup $group
 * @property User $user
 */
class Access extends XModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Access the static model class
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
		return 'tbl_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, group_id', 'required'),
			array('user_id, group_id', 'numerical', 'integerOnly'=>true),
            array('group_id', 'uniqueEntryValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, group_id', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'UserGroup', 'group_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
        //$labels = GenericProperties::getCacheLabels();
		return array(
			'id' => $L->g('ID'),
			'user_id' => $L->g("User"),
			'group_id' => $L->g("Group"),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function uniqueEntryValidator($attribute)
    {
        /**
         * @var $L Language
         */
        $L = self::$L;

        $model = $this->find("user_id=:user_id AND group_id=:group_id",
            array(
                ':user_id'=>$this->user_id,
                ':group_id'=>$this->group_id,
            ));

        if(isset($model->user_id))
        {

            if(!$this->isNewRecord and $this->id!=$model->id)
            {

                $this->addError($attribute,$L->g("Group already added for this user"));
            }
            elseif($this->isNewRecord)
            {
                $this->addError($attribute,$L->g("Group already added for this user"));
            }

        }
        /*else
        {
            $this->addError($attribute,'Error for me: '.$params['user']);
        }*/
    }

    public function getUserName($model)
    {
        return (isset($model->user->username))?$model->user->username:'N/A';
    }

    public function getGroupName($model)
    {
        return (isset($model->group->group))?$model->group->group:'N/A';
    }

    /*public function afterValidate()
    {
        Yii::app()->request->cookies->clear();
        return parent::afterValidate();
    }*/
}