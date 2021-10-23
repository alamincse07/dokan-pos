<?php

/**
 * This is the model class for table "daily_add_amount".
 *
 * The followings are the available columns in table 'daily_add_amount':
 * @property integer $id
 * @property string $category
 * @property integer $amount
 * @property string $date
 * @property string $name
 * @property string $taken_by
 */
class DailyAddAmount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DailyAddAmount the static model class
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
		return 'daily_add_amount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount', 'numerical', 'integerOnly'=>true),
			array('category', 'length', 'max'=>50),
			array('name, taken_by', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, amount, date, name, taken_by', 'safe', 'on'=>'search'),
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
			'category' => 'জমার প্রকার ',
			'amount' => 'টাকা',
			'date' => 'তারিখ',
			'name' => 'নাম',
			'taken_by' => 'ক্যাশিয়ার',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('taken_by',$this->taken_by,true);
$criteria->order=' id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}