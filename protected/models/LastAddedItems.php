<?php

/**
 * This is the model class for table "last_added_items".
 *
 * The followings are the available columns in table 'last_added_items':
 * @property integer $id
 * @property string $article
 * @property string $category
 * @property string $added_date
 * @property integer $total_pair
 * @property integer $total_taka
 * @property integer $actual_price
 * @property integer $body_rate
 * @property integer $last_added_pair
 * @property integer $last_added_taka
 * @property string $orginal_article
 */
class LastAddedItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LastAddedItems the static model class
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
		return 'last_added_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article, category, added_date', 'required'),
			array('total_pair, total_taka, actual_price, body_rate, last_added_pair, last_added_taka', 'numerical', 'integerOnly'=>true),
			array('article, orginal_article', 'length', 'max'=>255),
			array('category', 'length', 'max'=>144),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article, category, added_date, total_pair, total_taka, actual_price, body_rate, last_added_pair, last_added_taka, orginal_article', 'safe', 'on'=>'search'),
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

            'article' => 'আর্টিকেল ',
            'category' => 'ক্যাটাগরি',
            'added_date' => 'তোলার তারিখ',
            'total_pair' => 'মোট জোড়া',
            'total_taka' => 'মোট টাকা',
            'actual_price' => 'কেনাদাম',
            'body_rate' => 'বডিরেট',
            'last_added_pair' => 'শেষে তোলা জোড়া ',
            'last_added_taka' => 'শেষে তোলা টাকা',
			'orginal_article' => 'Orginal Article',
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

		if(isset($_REQUEST['article_name'])){

            $this->article=$_REQUEST['article_name'];
        }
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('total_pair',$this->total_pair);
		$criteria->compare('total_taka',$this->total_taka);
		$criteria->compare('actual_price',$this->actual_price);
		$criteria->compare('body_rate',$this->body_rate);
		$criteria->compare('last_added_pair',$this->last_added_pair);
		$criteria->compare('last_added_taka',$this->last_added_taka);
		$criteria->compare('orginal_article',$this->orginal_article,true);
		if(isset($_GET['article_name'],$_REQUEST['date_start'],$_REQUEST['date_end']) && trim($_REQUEST['date_start'])!='' && !empty($_GET['article_name'])){

            $criteria->addBetweenCondition('date(added_date)',$_REQUEST['date_start'],$_REQUEST['date_end']);

        }
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