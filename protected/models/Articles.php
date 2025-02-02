<?php

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property string $article
 * @property string $category
 * @property string $added_date
 * @property integer $total_pair
 * @property integer $total_taka
 * @property string $actual_price
 * @property integer $body_rate
 * @property integer $last_added_pair
 * @property integer $last_added_taka
 * @property string $orginal_article
 * @property string $increment
 * @property string $tags
 */
 class Articles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
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
		return 'articles';
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
			array('total_pair, total_taka, body_rate, last_added_pair, last_added_taka', 'numerical', 'integerOnly'=>true),
			array('article, orginal_article', 'length', 'max'=>255),
			array('category, tags', 'length', 'max'=>144),
			array('actual_price, increment', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article, category, added_date, total_pair, total_taka, actual_price, body_rate, last_added_pair, last_added_taka, orginal_article, increment, tags', 'safe', 'on'=>'search'),
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
			'orginal_article' => 'মালের নাম ',
			'increment' => 'বৃদ্ধি',
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

        if(isset($_REQUEST['search'])){
            $this->article=$_REQUEST['search'];
        }
		if(isset($_REQUEST['orginal_article'])){
            $this->orginal_article=$_REQUEST['orginal_article'];
        }
		
		$criteria->compare('id',$this->id);
		$criteria->compare('article',$this->article,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('added_date',$this->added_date,true);
		$criteria->compare('total_pair',$this->total_pair);
		$criteria->compare('total_taka',$this->total_taka);
		$criteria->compare('actual_price',$this->actual_price,true);
		$criteria->compare('body_rate',$this->body_rate);
		$criteria->compare('last_added_pair',$this->last_added_pair);
		$criteria->compare('last_added_taka',$this->last_added_taka);
		$criteria->compare('orginal_article',$this->orginal_article,true);
		$criteria->compare('increment',$this->increment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getTotalByTags($records, $column)
    {
		
        $records->pagination=false;
        $data=$records->getData();
        $total = 0;
        foreach ($data as $record) {
            $total += $record[$column];
        }
        return $total;
    }

	public function getTotal($records, $column)
    {
		if(!isset($_REQUEST['showCount'])){

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

	public function beforeSave() {

		$tags = explode(' ',$this->orginal_article);
		$this->tags = json_encode($tags, JSON_UNESCAPED_UNICODE);

		return parent::beforeSave();
	}
}