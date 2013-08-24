<?php

/**
 * This is the model class for table "{{cars}}".
 *
 * The followings are the available columns in table '{{cars}}':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $price
 * @property string $video1
 * @property string $video2
 * @property string $video3
 * @property string $meta_title
 * @property string $meta_keys
 * @property string $meta_desc
 * @property integer $gallery
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Cars extends EActiveRecord
{
	public function tableName()
	{
		return '{{cars}}';
	}

	
	public function rules()
	{
		return array(
			array('price, gallery, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('name, meta_title', 'length', 'max'=>255),
			array('video1, video2, video3, meta_keys, meta_desc', 'safe'),
			// The following rule is used by search().
			array('id, name, image, price, video1, video2, video3, meta_title, meta_keys, meta_desc, gallery, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'name' => 'название авто',
			'image' => 'фото авто',
			'price' => 'стоимость авто начинается от',
			'video1' => 'видео появляется на карточке товара. до 3х штук',
			'video2' => 'видео появляется на карточке товара. до 3х штук',
			'video3' => 'видео появляется на карточке товара. до 3х штук',
			'meta_title' => 'для сеошника',
			'meta_keys' => 'для сеошника',
			'meta_desc' => 'для сеошника',
			'gallery' => 'фотогалерея авто',
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
			'galleryManager' => array(
				'class' => 'admin.extensions.imagesgallery.GalleryBehavior',
				'idAttribute' => 'gallery',
				'versions' => array(
					'small' => array(
						'adaptiveResize' => array(90, 90),
					),
					'medium' => array(
						'resize' => array(600, 500),
					)
				),
				'name' => true,
				'description' => true,
			),
		));
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('video1',$this->video1,true);
		$criteria->compare('video2',$this->video2,true);
		$criteria->compare('video3',$this->video3,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keys',$this->meta_keys,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('gallery',$this->gallery);
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
		return 'Авто';
	}

}
