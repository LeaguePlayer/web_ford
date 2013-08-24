<?php

class MenuController extends AdminController
{
	public function actionCreate()
	{
		
			
		$model = new Menu;
		
		if(isset($_POST['Menu']))
		{
			$relationsSites = $_POST['Menu']['id_site'];
			unset($_POST['Menu']['id_site']);
			
			$model->attributes=$_POST['Menu'];
			
			
			
			if($model->save())
			{
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/menu/list/'));
			}
		}
		
		
		
		
		
		$this->render('create',array('model'=>$model));
	}
	
	
	public function actionUpdate($id)
	{
		
		
			
		$model = Menu::model()->with( array('sites_menu' => array('condition' => "post_type = 'Menu' and id_site = :id_site and post_id = {$id}",'params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($id);
		
		if(!is_object($model)) $model = Menu::model()->findByPk($id);
		// fnc::mpr($model->site->attributes);die();
		
		// проверяем может ли он редактировать
		$site_id_edited_user = Menu::model()->with( array('site_menu' => array('condition' => 'post_type = "Menu" and id_site = :id_site','params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($id)->site->id_site;
		if( (Yii::app()->user->id_site!=0) and ( Yii::app()->user->id_site!=$site_id_edited_user ) )
			throw new CHttpException(404, 'Unable to find the requested object.');
		// end
		
		if(isset($_POST['Menu']))
		{
			$relationsSites = $_POST['Menu']['id_site'];
			unset($_POST['Menu']['id_site']);
			
			
			
			$model->attributes=$_POST['Menu'];
			
			
			
			
			
			if($model->save())
			{
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/menu/list/'));	
			}
		}
		
		
		
		$this->render('update',array('model'=>$model));
	}
	
	
}
