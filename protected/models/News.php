<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property integer $id_type
 * @property string $title
 * @property string $html_content
 * @property integer $id_car
 * @property string $image
 * @property string $super_img
 * @property string $super_title
 * @property string $super_short_desc
 * @property string $super_full_desc
 * @property string $super_work_to
 * @property string $meta_title
 * @property string $meta_keys
 * @property string $meta_desc
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class News extends EActiveRecord
{
	public function tableName()
	{
		return '{{news}}';
	}

	
	public function rules()
	{
		return array(
			array('id_type, id_car, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('title, super_img, super_title, super_work_to, meta_title', 'length', 'max'=>255),
			array('html_content, super_short_desc, super_full_desc, meta_keys, meta_desc', 'safe'),
			// The following rule is used by search().
			array('id, id_type, title, html_content, id_car, image, super_img, super_title, super_short_desc, super_full_desc, super_work_to, meta_title, meta_keys, meta_desc, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'id_type' => 'Относится к',
			'title' => 'Заголовок',
			'html_content' => 'Текст',
			'id_car' => 'Привязать автомобиль',
			'image' => 'Изображение',
			'super_img' => 'Большое изображение',
			'super_title' => 'Заголовок',
			'super_short_desc' => 'Краткое описание',
			'super_full_desc' => 'Полное описание',
			'super_work_to' => 'Действует до',
			'meta_title' => 'META_TITLE',
			'meta_keys' => 'META_KEYS',
			'meta_desc' => 'META_DESC',
			'status' => 'Статус',
			'sort' => 'Вес для сортировки',
			'create_time' => 'Дата создания',
			'update_time' => 'Дата последнего редактирования',
		);
	}
	
	
	public function behaviors()
	{
		return CMap::mergeArray(parent::behaviors(), array(
			'UploadableImageBehavior' => array(
				'class' => 'admin.behaviors.UploadableImageBehavior',
				'versions' => array(
					'small' => array(
						'centeredpreview' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(600, 500),
					)
				),
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('html_content',$this->html_content,true);
		$criteria->compare('id_car',$this->id_car);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('super_img',$this->super_img,true);
		$criteria->compare('super_title',$this->super_title,true);
		$criteria->compare('super_short_desc',$this->super_short_desc,true);
		$criteria->compare('super_full_desc',$this->super_full_desc,true);
		$criteria->compare('super_work_to',$this->super_work_to,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keys',$this->meta_keys,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
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
		return 'Новости';
	}

}
