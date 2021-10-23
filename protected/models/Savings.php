<?php

/**
 * This is the model class for table "savings".
 *
 * The followings are the available columns in table 'savings':
 * @property integer $id
 * @property string $account_number
 * @property string $registration_no
 * @property string $owner
 * @property integer $amount
 * @property integer $interval
 * @property string $rate
 * @property string $opend_date
 * @property string $last_taken
 * @property string $next_date
 * @property integer $period
 *
 * The followings are the available model relations:
 * @property SavingsHistory[] $savingsHistories
 */
class Savings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Savings the static model class
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
		return 'savings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, interval, period', 'numerical', 'integerOnly'=>true),
			array('account_number, registration_no, owner', 'length', 'max'=>255),
			array('rate', 'length', 'max'=>20),
			array('opend_date, last_taken, next_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, account_number, registration_no, owner, amount, interval, rate, opend_date, last_taken, next_date, period', 'safe', 'on'=>'search'),
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
			'savingsHistories' => array(self::HAS_MANY, 'SavingsHistory', 'savings_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_number' => 'Account Number',
			'registration_no' => 'Registration No',
			'owner' => 'Owner',
			'amount' => 'Amount',
			'interval' => 'Interval',
			'rate' => 'Rate',
			'opend_date' => 'Opend Date',
			'last_taken' => 'Last Taken',
			'next_date' => 'Next Date',
			'period' => 'Period',
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
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('registration_no',$this->registration_no,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('interval',$this->interval);
		$criteria->compare('rate',$this->rate,true);
		$criteria->compare('opend_date',$this->opend_date,true);
		$criteria->compare('last_taken',$this->last_taken,true);
		$criteria->compare('next_date',$this->next_date,true);
		$criteria->compare('period',$this->period);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}