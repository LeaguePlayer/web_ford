<?php

Yii::import('admin.actions.*');

class AdminController extends CController
{
    public $layout = '/layouts/admin_columns';

    public $breadcrumbs = array();

    public $menu = array();
	
	public $defaultAction = 'list';
	
	
	public $id_site;
	public $settings;
	public $url_settings;
	public $available_array_domains;
	
	
	public function actions()
    {
        return array(
            'list' => 'ListAction',
			'create' => 'CreateAction',
            'update' => 'UpdateAction',
            'delete' => 'DeleteAction',
            'restore' => 'RestoreAction',
            'view' => 'ViewAction',
        );
    }
	
	
	/**
	 * Loads the requested data model.
	 * @param string the model class name
	 * @param integer the model ID
	 * @param array additional search criteria
	 * @param boolean whether to throw exception if the model is not found. Defaults to true.
	 * @return CActiveRecord the model instance.
	 * @throws CHttpException if the model cannot be found
	 */
	protected function loadModel($class, $id, $criteria = array(), $exceptionOnNull = true)
	{
		if (empty($criteria)) {
			$model = CActiveRecord::model($class)->findByPk($id);
		} else {
			$finder = CActiveRecord::model($class);
			$c = new CDbCriteria($criteria);
			$c->mergeWith(array(
				'condition' => $finder->tableSchema->primaryKey . '=:id',
				'params' => array(':id' => $id),
			));
			$model = $finder->find($c);
		}
		if (isset($model))
			return $model;
		else if ($exceptionOnNull)
			throw new CHttpException(404, 'Unable to find the requested object.');
	}
	
	
	public function init(){
		parent::init();
		
		
		// получаем версию сайта
		date_default_timezone_set("Asia/Dhaka");
		$fnc = new Fnc;
		$this->id_site = $fnc->returnIDSetting($_SERVER['SERVER_NAME']);
		$this->settings = Settingsite::model()->findByPk($this->id_site);
		
		
		if(!Yii::app()->user->isGuest)
		{
			$this->available_array_domains = $fnc->returnAvailableDomains(Yii::app()->user->id_site);
			
			if(Yii::app()->user->id_site==0)
				$this->url_settings = "/admin/settingsite/list";	
			else $this->url_settings = "/admin/settingsite/update/id/{$this->id_site}";
		}
			
		
		
		
		//fnc::mpr($this->settings->attributes);
	}
	
	
	
	/*public function filters()
    {
        return array(
            'accessControl',
        );
    }
 
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny',
            	'users'=>array('*'),
            ),
        );
    }*/
}