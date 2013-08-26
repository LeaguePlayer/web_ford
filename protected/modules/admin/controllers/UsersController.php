<?php

class UsersController extends AdminController
{
	public function actionCreate()
	{
		
			
		$model = new Users;
		
		if(isset($_POST['Users']))
		{
			$relationsSites = $_POST['Users']['id_site'];
			unset($_POST['Users']['id_site']);
			
			$model->attributes=$_POST['Users'];
			$model->password = md5($model->password);
			
			
			if($model->save())
			{
				if(empty($relationsSites)) $relationsSites=array(Yii::app()->user->id_site);
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/users/list/'));
			}
		}
		
		
		
		
		
		$this->render('create',array('model'=>$model));
	}
	
	
	public function actionUpdate($id)
	{
		
		
			
		$model = Users::model()->with( 'sites' )->findByPk($id);
		if(!is_object($model)) $model = Users::model()->findByPk($id);
		
		
		//
		if($model->validForEdit())
			throw new CHttpException(404, 'Unable to find the requested object.');
			//
		
		if(isset($_POST['Users']))
		{
			$relationsSites = $_POST['Users']['id_site'];
			unset($_POST['Users']['id_site']);
			
			
			$ex_password = $model->password;
			$model->attributes=$_POST['Users'];
			
			if($ex_password!=$model->password)
				$model->password = md5($model->password);
			
			
			
			if($model->save())
			{
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/users/list/'));	
			}
		}
		
		
		
		$this->render('update',array('model'=>$model));
	}
	
	
	public function actionList()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
			
	

		$this->render('list',array(
			'model'=>$model, 
			
			
		));
	}
	
}
