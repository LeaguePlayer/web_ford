<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $id_site
 * @property string $login
 * @property string $password
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Users extends EActiveRecord
{
	public function tableName()
	{
		return '{{users}}';
	}

	
	public function rules()
	{
		return array(
			array('login, password', 'required'),
			array('login','unique', 'message'=>'Пользователь с таким логином уже существует'),
			array('status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('login, password', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, id_site, login, password, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
			'sites' => array(self::HAS_MANY, 'Objectrelations', 'post_id'),
			'site' => array(self::HAS_ONE, 'Objectrelations', 'post_id', 'order'=>'site.id_site ASC'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			
			'login' => 'Логин пользователя',
			'password' => 'Пароль',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	

	
	public function search()
	{
		$criteria=new CDbCriteria;
		
		

		$criteria->compare('id',$this->id);
		
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		 
		if(Yii::app()->user->id_site!=0)
		{
			$criteria->with = array('site' => array('condition'=>"post_type='Users' and id_site = :id_site",'params'=>array(':id_site'=>Yii::app()->controller->id_site)) );
			//$criteria->addCondition("t.status = 0");
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function translition()
	{
		return 'Пользователи';
	}
	
	public function getModelName()
	{
		return __CLASS__;
	}

}
