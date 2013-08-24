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
				$model->relationsSites($relationsSites, $model->getModelName());
				$this->redirect(array('/admin/users/list/'));
			}
		}
		
		
		
		
		
		$this->render('create',array('model'=>$model));
	}
	
	
	public function actionUpdate($id)
	{
		
		
			
		$model = Users::model()->with( array('sites' => array('condition' => 'post_type = "Users"')) )->findByPk($id);
		if(!is_object($model)) $model = Users::model()->findByPk($id);
		
		$site_id_edited_user = Users::model()->with( array('site' => array('condition' => 'post_type = "Users" and id_site = :id_site','params'=>array(':id_site'=>Yii::app()->user->id_site))) )->findByPk($id)->site->id_site;
		
		if( (Yii::app()->user->id_site!=0) and ( Yii::app()->user->id_site!=$site_id_edited_user ) )
			throw new CHttpException(404, 'Unable to find the requested object.');
		
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
