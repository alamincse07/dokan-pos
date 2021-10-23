<?php

/**
 * This is the model class for table "money_back_iteams".
 *
 * The followings are the available columns in table 'money_back_iteams':
 * @property integer $id
 * @property string $article
 * @property integer $amount
 * @property string $manager
 * @property string $date
 */
class MoneyBackIteams extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MoneyBackIteams the static model class
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
		return 'money_back_iteams';
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
			array('article, manager', 'length', 'max'=>50),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article, amount, manager, date', 'safe', 'on'=>'search'),
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
			//'id' => 'ID',
			'article' => 'Article',
			'amount' => 'Amount',
			'manager' => 'Manager',
			'date' => 'Date',
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
		if(isset($_REQUEST['article_name'])){

            $this->article=$_REQUEST['article_name'];
        }
		$criteria->compare('id',$this->id);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('date',$this->date,true);
		if(isset($_GET['article_name'],$_REQUEST['date_start'],$_REQUEST['date_end']) && trim($_REQUEST['date_start'])!='' && !empty($_GET['article_name'])){

            $criteria->addBetweenCondition('date(date)',$_REQUEST['date_start'],$_REQUEST['date_end']);

        }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}