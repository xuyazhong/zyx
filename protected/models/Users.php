<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $userid
 * @property string $username
 * @property string $password
 * @property string $role
 * @property integer $level
 */
class Users extends CActiveRecord
{
	const LEVEL_REGISTERED=0, LEVEL_AUTHOR=1, LEVEL_ADMIN=50, LEVEL_SUPERADMIN=99;
	public $repeat_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
/*			array('level', 'required'),*/
			//array('level', 'numerical', 'integerOnly'=>true),
			array('username', 'required','length', 'max'=>32),
           array('password', 'required','length', 'max'=>32),
			//array('role', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, username, password, role, level', 'safe', 'on'=>'search'),
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
			'userid' => '编号',
			'username' => '用户名',
			'password' => '密码',
			'role' => 'role',
			'level' => '级别',
		);
	}

	static function getAccessLevelList( $level = null ){
        $levelList=array(
            //self::LEVEL_REGISTERED => '注册用户',
            self::LEVEL_AUTHOR => '学生',
            self::LEVEL_ADMIN => '管理员',
            self::LEVEL_SUPERADMIN=>'超级管理员',
        );
        if( $level === null)
            return $levelList;
        return $levelList[ $level ];
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}