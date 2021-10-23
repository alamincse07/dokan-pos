<?php

/**
 * This is the model class for table "customer_due_information".
 *
 * The followings are the available columns in table 'customer_due_information':
 * @property integer $id
 * @property string $area_name
 * @property string $occupation
 * @property string $name
 * @property string $articles
 * @property integer $amount
 * @property string $manager
 * @property string $date
 */
class CustomerDueInformation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerDueInformation the static model class
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
		return 'customer_due_information';
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
			array('area_name, occupation, name,  manager', 'length', 'max'=>255),
			array('date,articles', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_name, occupation, name, articles, amount, manager, date', 'safe', 'on'=>'search'),
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
			'area_name' => 'এলাকা',
			'occupation' => 'পেশা',
			'name' => 'নাম',
			'articles' => 'জুতা',
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
		$criteria->compare('area_name',$this->area_name,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('articles',$this->articles,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('date',$this->date,true);
$criteria->order=' id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}