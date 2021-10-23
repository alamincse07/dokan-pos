<?php

/**
 * This is the model class for table "due_information".
 *
 * The followings are the available columns in table 'due_information':
 * @property integer $id
 * @property string $area_name
 * @property string $occupation
 * @property string $customer_name
 * @property string $product
 * @property integer $price
 * @property string $added_date
 */
class DueInformation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DueInformation the static model class
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
		return 'due_information';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, price', 'numerical', 'integerOnly'=>true),
			array('area_name, occupation, customer_name, product', 'length', 'max'=>255),
			array('added_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_name, occupation, customer_name, product, price, added_date', 'safe', 'on'=>'search'),
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
			'area_name' => 'Area Name',
			'occupation' => 'Occupation',
			'customer_name' => 'Customer Name',
			'product' => 'Product',
			'price' => 'Price',
			'added_date' => 'Added Date',
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
		$criteria->compare('customer_name',$this->customer_name,true);
		$criteria->compare('product',$this->product,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('added_date',$this->added_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}