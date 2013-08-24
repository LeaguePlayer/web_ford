<?php

/**
 * This is the model class for table "{{object_relations}}".
 *
 * The followings are the available columns in table '{{object_relations}}':
 * @property integer $id
 * @property integer $id_site
 * @property integer $post_id
 * @property string $post_type
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Objectrelations extends EActiveRecord
{
	public function tableName()
	{
		return '{{object_relations}}';
	}

	
	public function rules()
	{
		return array(
			array('id_site, post_id, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('post_type', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id, id_site, post_id, post_type, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_site' => 'ID_SITE',
			'post_id' => 'POST_ID',
			'post_type' => 'POST_TYPE',
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
		$criteria->compare('id_site',$this->id_site);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

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
		return 'Objectrelations';
	}

}
