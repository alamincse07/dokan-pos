<?php

/**
 * This is the model class for table "tbl_user_group".
 *
 * The followings are the available columns in table 'tbl_user_group':
 * @property integer $id
 * @property string $group
 * @property string $create_date
 * @property string $update_date
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Access[] $accesses
 * @property GroupPermission[] $groupPermissions
 */
class UserGroup extends XModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserGroup the static model class
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
		return 'tbl_user_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group, create_date', 'required'),
            array('group','unique'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('group', 'length', 'max'=>255),
			array('update_date', 'safe'),
			array('group', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group, create_date, update_date, active', 'safe', 'on'=>'search'),
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
			'accesses' => array(self::HAS_MANY, 'Access', 'group_id'),
			'groupPermissions' => array(self::HAS_MANY, 'GroupPermission', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        //$labels = GenericProperties::getCacheLabels();
        /**
         * @var $L Language
         */
        $L = self::$L;
		return array(
			'id' => $L->g('ID'),
			'group' => $L->g('User Group'),
			'create_date' => $L->g('Create Date'),
			'update_date' => $L->g('Update Date'),
			'active' => $L->g('Active'),
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
		#$criteria->compare('"group"',$this->group,true);
        $criteria->addSearchCondition('`group`', $this->group, true, 'AND', 'LIKE');
       # $criteria->addSearchCondition('create_date',$this->create_date, true, 'AND', 'ILIKE');
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeValidate()
    {
        if($this->isNewRecord)
        {
            $this->create_date = date("Y-m-d H:i:s"); #change from 14 to 2014 format

        }
        else
        {
            $this->update_date = date("Y-m-d H:i:s");
        }

        return parent::beforeValidate();
    }

    /*public function afterValidate()
    {
        Yii::app()->request->cookies->clear();
        return parent::afterValidate();
    }*/

    public function getUserGroupComboService($active=1) #changed here $active =true
    {
        return CHtml::listData($this->findAll("active=:active",array(':active'=>$active)),'id','group');
    }

    public function getActiveText($model)
    {
        return (isset($model->active))?(isset(Enum::yesNo()[$model->active]))?Enum::yesNo()[$model->active]:'N/A':'N/A';
    }
}