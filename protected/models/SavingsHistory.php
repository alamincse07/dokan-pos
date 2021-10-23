<?php

/**
 * This is the model class for table "savings_history".
 *
 * The followings are the available columns in table 'savings_history':
 * @property integer $id
 * @property integer $savings_id
 * @property string $pull_date
 * @property integer $term
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Savings $savings
 */
class SavingsHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'savings_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('savings_id, term, status', 'numerical', 'integerOnly'=>true),
			array('pull_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, savings_id, pull_date, term, status', 'safe', 'on'=>'search'),
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
			'savings' => array(self::BELONGS_TO, 'Savings', 'savings_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'savings_id' => 'Savings',
			'pull_date' => 'Pull Date',
			'term' => 'Term',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('savings_id',$this->savings_id);
		$criteria->compare('pull_date',$this->pull_date,true);
		$criteria->compare('term',$this->term);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SavingsHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public  static function GetNextDate($id){
        $date=(isset($_GET['date']))?$_GET['date']:date('Y-m-d');

        $sql=" SELECT
savings_history.pull_date

FROM
savings_history

WHERE savings_history.pull_date >= '$date' and savings_history.`status`!=1 and savings_id=$id limit 1 ";



        $data1=Yii::app()->db->createCommand($sql)->queryRow();


        return $data1['pull_date'];
    }
}
