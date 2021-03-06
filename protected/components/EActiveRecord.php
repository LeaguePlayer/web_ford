<?php
/**
 * EActiveRecord class
 *
 * Some cool methods to share amount your models
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EActiveRecord extends CActiveRecord
{
	// Статусы в базе данных
	const STATUS_CLOSED = 0;
	const STATUS_PUBLISH = 1;
    const STATUS_REMOVED = 3;
    const STATUS_DEFAULT = self::STATUS_PUBLISH;

	public static function getStatusAliases($status = -1)
	{
		$aliases = array(
			self::STATUS_CLOSED => 'Не опубликовано',
			self::STATUS_PUBLISH => 'Опубликовано',
            self::STATUS_REMOVED => 'Удалено',
			);

		if ($status > -1)
			return $aliases[$status];
		
		return $aliases;
	}
	
	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
			)
		);
	}
    
    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status='.self::STATUS_PUBLISH,
            ),
            'closed' => array(
                'condition' => 't.status='.self::STATUS_CLOSED,
            ),
        );
    }
    
    public function removed()
    {
        $this->resetScope()->getDbCriteria()->mergeWith(array(
            'condition' => 'status=' . self::STATUS_REMOVED
        ));
        
        return $this;
    }
    
    public function restore()
    {
        if($this->isNewRecord)
            throw new CDbException(Yii::t('yii','The active record cannot be deleted because it is new.'));
        
        if($this->status != self::STATUS_REMOVED)
            return false;
        
        $this->status = self::STATUS_DEFAULT;
        $this->save(false, array('status'));
        
        return true;
    }

	/**
	 * default form ID for the current model. Defaults to get_class()+'-form'
	 */
	private $_formId;

	public function setFormId($value)
	{
		$this->_formId = $value;
	}

	public function getFormId()
	{
		if (null !== $this->_formId)
			return $this->_formId;
		else
		{
			$this->_formId = strtolower(get_class($this)) . '-form';
			return $this->_formId;
		}
	}

	/**
	 * default grid ID for the current model. Defaults to get_class()+'-grid'
	 */
	private $_gridId;

	public function setGridId($value)
	{
		$this->_gridId = $value;
	}

	public function getGridId()
	{
		if (null !== $this->_gridId)
			return $this->_gridId;
		else
		{
			$this->_gridId = strtolower(get_class($this)) . '-grid';
			return $this->_gridId;
		}
	}

	/**
	 * default list ID for the current model. Defaults to get_class()+'-list'
	 */
	private $_listId;

	public function setListId($value)
	{
		$this->_listId = $value;
	}

	public function getListId()
	{
		if (null !== $this->_listId)
			return $this->_listId;
		else
		{
			$this->_listId = strtolower(get_class($this)) . '-list';
			return $this->_listId;
		}
	}

	/**
	 * Logs the record update information.
	 * Updates the four columns: create_user_id, create_date, last_update_user_id and last_update_date.
	 */
	protected function logUpdate()
	{
		$userId = php_sapi_name() === 'cli'
			? -1
			: Yii::app()->user->id;

		foreach (array('create_user_id' => $userId, 'create_date' => time()) as $attribute => $value)
			$this->updateLogAttribute($attribute, $value, (!($userId===-1 || Yii::app()->user->isGuest) && $this->isNewRecord));

		foreach (array('last_update_user_id' => $userId, 'last_update_date' => time()) as $attribute => $value)
			$this->updateLogAttribute($attribute, $value, (!($userId===-1 || Yii::app()->user->isGuest) && !$this->isNewRecord));
	}

	/**
	 * Helper function to update attributes
	 * @param $attribute
	 * @param $value
	 * @param $check
	 */
	protected function updateLogAttribute($attribute, $value, $check)
	{
		if ($this->hasAttribute($attribute) && $check)
			$this->$attribute = $value;
	}

	/**
	 * updates the log fields before saving
	 * @return boolean
	 */
	public function beforeSave()
	{
		$this->logUpdate();
		return parent::beforeSave();
	}
    
    public function beforeDelete()
    {
        if($this->status == self::STATUS_DEFAULT)
        {
            $this->status = self::STATUS_REMOVED;
            $this->save(false, array('status'));
        
            return false;
        }
        
        return parent::beforeDelete();
    }
	
	public function translition()
	{
		return get_class($this);
	}
	
	public function getCreateDate()
	{
		return SiteHelper::russianDate($this->create_time).' в '.date('H:i', $this->create_time);
	}
	
	public function getUpdateDate()
	{
		if ( !empty($this->update_time) )
			return SiteHelper::russianDate($this->update_time).' в '.date('H:i', $this->update_time);
	}
	
	public function relationsSites($array, $post_type)
	{
		
		//echo count($array);die();
		$actual_values = array("999999999");
		
		
		if(count($array) >0 )
		{
			
			
			foreach ($array as $value)
			{
				$actual_values[] = $value;
				
				$check_this_value = Objectrelations::model()->find("post_type = '{$post_type}' and post_id={$this->id} and id_site={$value}");
				//echo "post_type = '{$post_type}' and post_id={$this->id} and id_site={$value}<br>";
				
				
				if(!is_object($check_this_value))
				{
					//echo "saved<br>";
					$object = new Objectrelations;
					$object->id_site = $value;
					$object->post_type = $post_type;
					$object->post_id = $this->id;
					$object->save();
				}
			}
			
			// удаляем те ключи, которые были сняты
			
			//die();
			
		}
		
		if(Yii::app()->user->id_site!=0) return false;
		if(count($actual_values)>0)
			{
				$sql_condition = implode(", ",$actual_values);	
			
				Objectrelations::model()->deleteAll("id_site not in ($sql_condition) and post_type = '{$post_type}' and  post_id={$this->id}");
			}
			
		
	}
	
	
	public function validForEdit()
	{
		
		$site_id_edited_user = $this->with( array('site' => array('condition' => '(id_site = :id_site or id_site=0)','params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($this->id)->site->id_site;
		//echo count($site_id_edited_user);die();
		
		//echo $site_id_edited_user;die();
		if(Yii::app()->user->id_site==0) return false;
		
		if(  ( Yii::app()->user->id_site!=$site_id_edited_user and $site_id_edited_user!=0 ) or count($site_id_edited_user)==0 )
			return true;
		else return false;
			
	}
	
	
	
}
