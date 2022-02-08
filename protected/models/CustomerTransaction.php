<?php

/**
 * This is the model class for table "customer_transaction".
 *
 * The followings are the available columns in table 'customer_transaction':
 * @property integer $id
 * @property string $date
 * @property string $transaction_type
 * @property integer $amount
 * @property integer $total_due
 * @property integer $customer_id
 */
class CustomerTransaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerTransaction the static model class
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
		return 'customer_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, total_due, customer_id', 'numerical', 'integerOnly'=>true),
			array('transaction_type', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, transaction_type, amount, total_due, customer_id', 'safe', 'on'=>'search'),
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
			'date' => 'তারিখ',
			'transaction_type' => 'দেয়াও / নেওয়া',
			'amount' => 'টাকা',
			'total_due' =>'ঐ সময় দেওয়া ',
			'customer_id' => 'ক্রেতা ',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('transaction_type',$this->transaction_type,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('total_due',$this->total_due);
		$criteria->compare('customer_id',$this->customer_id);
$criteria->order=' id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}