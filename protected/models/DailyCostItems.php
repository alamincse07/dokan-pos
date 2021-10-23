<?php

/**
 * This is the model class for table "daily_cost_items".
 *
 * The followings are the available columns in table 'daily_cost_items':
 * @property integer $id
 * @property string $cost_type
 * @property string $amount
 * @property string $manager
 * @property string $date
 */
class DailyCostItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DailyCostItems the static model class
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
		return 'daily_cost_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cost_type', 'length', 'max'=>1000),
			array('amount, manager', 'length', 'max'=>50),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cost_type, amount, manager, date', 'safe', 'on'=>'search'),
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
			'cost_type' => 'খরচের নাম',
			'amount' => 'টাকা',
			'manager' => 'ক্যাশিয়ার',
			'date' => 'তারিখ',
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
		$criteria->compare('cost_type',$this->cost_type,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}