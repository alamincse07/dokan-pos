<?php

/**
 * This is the model class for table "tbl_group_permission".
 *
 * The followings are the available columns in table 'tbl_group_permission':
 * @property integer $id
 * @property string $controller
 * @property string $action
 * @property integer $group_id
 * @property string $create_date
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property UserGroup $group
 * @property GroupPermission $model
 */
class GroupPermission extends XModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupPermission the static model class
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
		return 'tbl_group_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controller, action, group_id, create_date', 'required'),
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('controller, action', 'length', 'max'=>255),
			array('update_date', 'safe'),
            array('action', 'uniquePermissionValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, controller, action, group_id, create_date, update_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
       // $labels = GenericProperties::getCacheLabels();
        /**
         * @var $L Language
         */
        $L = self::$L;
		return array(
			'id' => $L->g('ID'),
			'controller' =>$L->g('Module') ,#'Controller',
			'action' => $L->g('Page'),#'Action',
			'group_id' => $L->g('Group Id'),
			'create_date' => $L->g('Create Date'),
			'update_date' => $L->g('Update Date'),
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
		#$criteria->compare('controller',strtolower($this->controller),true);
		#$criteria->compare('action',strtolower($this->action),true);
        $criteria->addSearchCondition('controller', $this->controller, true, 'AND', 'LIKE');
        $criteria->addSearchCondition('action', $this->action, true, 'AND', 'LIKE');
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeValidate()
    {
        if($this->isNewRecord)
        {
            $this->create_date = date("Y-m-d H:i:s");
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

    public function getGroupName($model)
    {
        return $model->group->group;
    }

    public function uniquePermissionValidator($attribute)
    {

        $model = $this->find("controller=:controller AND action=:action AND group_id=:group_id",
            array(':controller'=>$this->controller,
                ':action'=>$this->action,
                ':group_id'=>$this->group_id,
            ));

        if(isset($model->action) and $model->action==$this->action)
        {

            if(!$this->isNewRecord and $this->id!=$model->id)
            {

                $this->addError($attribute,"Action '".ucfirst($this->action)."' already added for this user");
            }
            elseif($this->isNewRecord)
            {
                $this->addError($attribute,"Action '".$this->action."' already added for this user");
            }

        }
        /*else
        {
            $this->addError($attribute,'Error for me: '.$params['user']);
        }*/
    }
}