<?php

/**
 * This is the model class for table "{{setting_site}}".
 *
 * The followings are the available columns in table '{{setting_site}}':
 * @property integer $id
 * @property string $link_on_facebook
 * @property string $link_on_vk
 * @property string $link_on_twitter
 * @property string $link_on_webcam
 * @property string $email_main_admin
 * @property string $email_test_drive
 * @property string $email_feedback
 * @property string $email_strahovanie
 * @property string $email_service
 * @property string $email_credit
 * @property string $phone_code_city
 * @property string $phone_sales
 * @property string $phone_service
 * @property string $street
 * @property string $access_to_test_drive
 * @property integer $rows_stock_in_main
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 */
class Settingsite extends EActiveRecord
{
	public function tableName()
	{
		return '{{setting_site}}';
	}

	
	public function rules()
	{
		return array(
			array('email_main_admin, phone_code_city, rows_stock_in_main', 'required'),
			array('rows_stock_in_main, status, sort, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('link_on_facebook, link_on_vk, link_on_twitter, link_on_webcam, email_main_admin, email_test_drive, email_feedback, email_strahovanie, email_service, email_credit, phone_code_city, phone_sales, phone_service, street', 'length', 'max'=>255),
			array('access_to_test_drive', 'safe'),
			// The following rule is used by search().
			array('id, link_on_facebook, link_on_vk, link_on_twitter, link_on_webcam, email_main_admin, email_test_drive, email_feedback, email_strahovanie, email_service, email_credit, phone_code_city, phone_sales, phone_service, street, access_to_test_drive, rows_stock_in_main, status, sort, create_time, update_time', 'safe', 'on'=>'search'),
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
			'link_on_facebook' => 'Ссылка на группу в фейсбук',
			'link_on_vk' => 'Ссылка на группу в вконтакте',
			'link_on_twitter' => 'Ссылка на твиттер',
			'link_on_webcam' => 'Ссылка на вебкамеру',
			'email_main_admin' => 'Почта главного администратора',
			'email_test_drive' => 'Почта для получения заявок на тест-драйв',
			'email_feedback' => 'Почта для получения заявок с сайта',
			'email_strahovanie' => 'Почта для получения заявок по страхованию',
			'email_service' => 'Почта для получения заявок на сервис',
			'email_credit' => 'Почта для получения заявок на кредит',
			'phone_code_city' => 'Код города',
			'phone_sales' => 'Телефон отдела продаж',
			'phone_service' => 'Телефон сервисного обслуживания',
			'street' => 'Адрес автосалона (например: Тюмень, Пермякова 1, строение 5)',
			'access_to_test_drive' => 'Автомобили доступные для тест-драйва',
			'rows_stock_in_main' => 'Количество акций выводимых на главной страницы',
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
		$criteria->compare('link_on_facebook',$this->link_on_facebook,true);
		$criteria->compare('link_on_vk',$this->link_on_vk,true);
		$criteria->compare('link_on_twitter',$this->link_on_twitter,true);
		$criteria->compare('link_on_webcam',$this->link_on_webcam,true);
		$criteria->compare('email_main_admin',$this->email_main_admin,true);
		$criteria->compare('email_test_drive',$this->email_test_drive,true);
		$criteria->compare('email_feedback',$this->email_feedback,true);
		$criteria->compare('email_strahovanie',$this->email_strahovanie,true);
		$criteria->compare('email_service',$this->email_service,true);
		$criteria->compare('email_credit',$this->email_credit,true);
		$criteria->compare('phone_code_city',$this->phone_code_city,true);
		$criteria->compare('phone_sales',$this->phone_sales,true);
		$criteria->compare('phone_service',$this->phone_service,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('access_to_test_drive',$this->access_to_test_drive,true);
		$criteria->compare('rows_stock_in_main',$this->rows_stock_in_main);
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
		return 'Настройки сайта';
	}

}
