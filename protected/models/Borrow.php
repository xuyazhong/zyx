<?php

/**
 * This is the model class for table "borrow".
 *
 * The followings are the available columns in table 'borrow':
 * @property integer $id
 * @property integer $book_id
 * @property string $book_title
 * @property string $borrow_date
 * @property string $borrow_time
 * @property string $back_date
 * @property string $back_time
 * @property integer $user_id
 */
class Borrow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Borrow the static model class
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
		return 'borrow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, book_title, borrow_date, borrow_time, back_date, back_time, user_id', 'required'),
			array('book_id, user_id', 'numerical', 'integerOnly'=>true),
			array('book_title, borrow_date, borrow_time, back_date, back_time', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, book_id, book_title, borrow_date, borrow_time, back_date, back_time, user_id', 'safe', 'on'=>'search'),
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
			'id' => '编号',
			'book_id' => '书号',
			'book_title' => '书名',
			'borrow_date' => '借书日期',
			'borrow_time' => '借书时间',
           'back_date' => '还书期限',
           'back_time' => '还书时间',
			'user_id' => '用户',
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
        $criteria->compare('book_id',$this->book_id);
        $criteria->compare('book_title',$this->book_title,true);
        $criteria->compare('borrow_date',$this->borrow_date,true);
        $criteria->compare('borrow_time',$this->borrow_time,true);
        $criteria->compare('back_date',$this->back_date,true);
        $criteria->compare('back_time',$this->back_time,true);
        $criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}