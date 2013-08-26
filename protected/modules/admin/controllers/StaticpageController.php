<?php

class StaticpageController extends AdminController
{
	public function actionCreate()
	{
		
			
		$model = new Staticpage;
		
		if(isset($_POST['Staticpage']))
		{
			$relationsSites = $_POST['Staticpage']['id_site'];
			unset($_POST['Staticpage']['id_site']);
			
			$model->attributes=$_POST['Staticpage'];
			
			if(empty($model->meta_alias))
				$model->meta_alias = fnc::str2url($model->title);
				
			
			//fnc::mpr($relationsSites);die();
			
			if($model->save())
			{
				if(empty($relationsSites)) $relationsSites=array(Yii::app()->user->id_site);
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/staticpage/list/'));
			}
		}
		
		
		
		
		
		$this->render('create',array('model'=>$model));
	}
	
	
	public function actionUpdate($id)
	{
		
		
			
		$model = Staticpage::model()->with( array('sites' => array('condition' => "id_site = :id_site and post_id = {$id}",'params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($id);
		
		if(!is_object($model)) $model = Staticpage::model()->findByPk($id);
		// fnc::mpr($model->site->attributes);die();
		
		// проверяем может ли он редактировать
		
		if($model->validForEdit())
			throw new CHttpException(404, 'Unable to find the requested object.');
		// end
		
		
		
		if(isset($_POST['Staticpage']))
		{
			$relationsSites = $_POST['Staticpage']['id_site'];
			unset($_POST['Staticpage']['id_site']);
			
			
			
			$model->attributes=$_POST['Staticpage'];
			
			
			if(empty($model->meta_alias))
				$model->meta_alias = fnc::str2url($model->title);
			
			if($model->save())
			{
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/staticpage/list/'));	
			}
		}
		
		
		
		$this->render('update',array('model'=>$model));
	}
}
