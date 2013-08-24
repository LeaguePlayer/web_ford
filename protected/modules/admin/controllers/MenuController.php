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
		
		
			
		$model = Menu::model()->with( array('sites' => array('condition' => "id_site = :id_site and post_id = {$id}",'params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($id);
		
		if(!is_object($model)) $model = Menu::model()->findByPk($id);
		// fnc::mpr($model->site->attributes);die();
		
		// проверяем может ли он редактировать
		
		if($model->validForEdit())
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
	
	
	public function actionSort()
    {
		
         if (isset($_POST['items']) && is_array($_POST['items'])) {
			 
			 if(Yii::app()->user->id_site!=0)
				 $get_all_menus_for_this_site = Menu::model()->with( array('site' => array('condition' => 'id_site = :id_site','params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findAll();
			 else
			 	$get_all_menus_for_this_site = Menu::model()->findAll();
			 
			 
			 echo count($get_all_menus_for_this_site);die();
			 
				$i = 0;
				foreach ($_POST['items'] as $item) {
					
					$project = Menu::model()->findByPk($item);
					$project->sort = $i;
					
					if($project->update()) echo "OK";
					$i++;
				}
			}
    }
	
	
}
