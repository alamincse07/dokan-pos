<?php

/**
 * This is the model class for table "daily_sell_information".
 *
 * The followings are the available columns in table 'daily_sell_information':
 * @property integer $id
 * @property string $category
 * @property string $date
 * @property string $article
 * @property string $size
 * @property string $color
 * @property string $manager
 * @property string $sells_man
 * @property string $price
 * @property string $profit
 */
class DailySellInformation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DailySellInformation the static model class
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
		return 'daily_sell_information';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'required'),
			array('category', 'length', 'max'=>255),
			array('article, manager, sells_man', 'length', 'max'=>55),
			array('size, color, price, profit', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, date, article, size, color, manager, sells_man, price, profit', 'safe', 'on'=>'search'),
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
			'category' => 'ক্যাটাগরী',
			'date' => 'তারিখ',
			'article' => 'আর্টিকেল',
			'size' => 'Size',
			'color' => 'Color',
			'manager' => 'ক্যাশিয়ার',
			'sells_man' => 'Sells Man',
			'price' => 'টাকা',
			'profit' => 'লাভ',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('sells_man',$this->sells_man,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('profit',$this->profit,true);
		$criteria->order=' id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTotal($records, $column)
    {
        $records->pagination=false;
        $data=$records->getData();
        $total = 0;
        foreach ($data as $record) {
            $total += $record->$column;
        }
        return $total;
    }
}