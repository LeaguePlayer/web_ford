<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property integer $id_site
 * @property integer $id_category
 * @property string $title
 * @property string $link
 * @property integer $show_on_main
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Menu extends EActiveRecord
{
	public function tableName()
	{
		return '{{menu}}';
	}

	
	public function rules()
	{
		return array(
			array('link, title', 'required'),
			array('id_category, show_on_main, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title, link', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, id_site, id_category, title, link, show_on_main, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
				'sites' => array(self::HAS_MANY, 'Objectrelations', 'post_id','condition'=>"post_type = 'Menu'"),
			'site' => array(self::HAS_ONE, 'Objectrelations', 'post_id', 'order'=>'site.id_site ASC','condition'=>"post_type = 'Menu'"),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_site' => 'Показывается на сайте',
			'id_category' => 'Относится к категории',
			'title' => 'Заголовок меню',
			'link' => 'Ссылка',
			'show_on_main' => 'Показывать в меню на главной',
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
		
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('show_on_main',$this->show_on_main);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		
		if(Yii::app()->user->id_site!=0)
		{
			$criteria->with = array('site' => array('condition'=>"id_site = :id_site",'params'=>array(':id_site'=>Yii::app()->controller->id_site)) );
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.sort ASC',
			  )
		));
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function translition()
	{
		return 'Меню';
	}
	
	public function getModelName()
	{
		return __CLASS__;
	}
	
	public function beforeSave()
	{
		parent::beforeSave();
		
		if($this->isNewRecord)
		{
			$get_last_sort_value = self::model()->find(array('order'=>'sort DESC'))->sort;
			$this->sort = $get_last_sort_value+1;
		}
		
		
		return true;
	}

}
