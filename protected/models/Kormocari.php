<?php

/**
 * This is the model class for table "kormocari".
 *
 * The followings are the available columns in table 'kormocari':
 * @property integer $id
 * @property string $name
 * @property string $taken_date
 * @property integer $leave
 * @property integer $amount
 * @property string $manager
 */
class Kormocari extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kormocari the static model class
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
		return 'kormocari';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('leave, amount', 'numerical', 'integerOnly'=>true),
			array('name, manager', 'length', 'max'=>255),
			array('taken_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, taken_date, leave, amount, manager', 'safe', 'on'=>'search'),
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
			'name' => 'নাম',
			'taken_date' => 'তারিখ',
			'leave' => 'ছুটি',
			'amount' => 'টাকা নেওয়া',
			'manager' => 'ক্যাশিয়ার',
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

        if(isset($_REQUEST['k_name'])){

            $this->name=$_REQUEST['k_name'];
        }
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('taken_date',$this->taken_date,true);
		$criteria->compare('leave',$this->leave);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('manager',$this->manager,true);
        if(isset($_REQUEST['date_start'],$_REQUEST['date_end']) && trim($_REQUEST['date_start'])!=''){

            $criteria->addBetweenCondition('date(taken_date)',$_REQUEST['date_start'],$_REQUEST['date_end']);

        }
		$criteria->order=' id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTotal($records, $column)
    {
		if(!isset($_REQUEST['k_name'])){

			return '';
		}
        $records->pagination=false;
        $data=$records->getData();
        $total = 0;
        foreach ($data as $record) {
            $total += $record->$column;
        }
        return $total;
    }

}