<?php

/**
 * This is the model class for table "cost_items".
 *
 * The followings are the available columns in table 'cost_items':
 * @property integer $id
 * @property string $cost_name
 * @property string $date
 * @property integer $cost_type
 */
class CostItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CostItems the static model class
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
		return 'cost_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cost_type', 'numerical', 'integerOnly'=>true),
			array('cost_name', 'length', 'max'=>500),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cost_name, date, cost_type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cost_name' => 'খরচের নাম',
			'date' => 'Date',
			'cost_type' => 'প্রকার |2=দোকানের লোক',
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
		$criteria->compare('cost_name',$this->cost_name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('cost_type',$this->cost_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}