<?php

class SettingSiteController extends AdminController
{
	
	public function actionUpdate($id)
	{
		
		if( (Yii::app()->user->id_site!=0) and ( Yii::app()->user->id_site!=$id ) )
			throw new CHttpException(404, 'Unable to find the requested object.');
		
		$model = $this->loadModel("Settingsite",$id);
		
		if(isset($_POST['Settingsite']))
		{
			
			$_POST['Settingsite']['access_to_test_drive'] = explode("\r\n",trim($_POST['Settingsite']['access_to_test_drive']));
			$_POST['Settingsite']['access_to_test_drive'] = serialize($_POST['Settingsite']['access_to_test_drive']);
			$model->attributes=$_POST['Settingsite'];
			
			
			
			if($model->save())
				$this->redirect(array('/admin/'));
		}
		
		if(!empty($model->access_to_test_drive))
		{
			$model->access_to_test_drive = unserialize($model->access_to_test_drive);
			$model->access_to_test_drive = implode("\r\n",$model->access_to_test_drive);
		}
		
		$this->render('update',array('model'=>$model));
	}
	
	public function actionCreate()
	{
		throw new CHttpException(404, 'Unable to find the requested object.');
	}
	
	public function actionList()
	{
		if( (Yii::app()->user->id_site!=0) and ( Yii::app()->user->id_site!=$id ) )
			$this->redirect(array("/admin/settingsite/update/id/".Yii::app()->user->id_site));
		
		$model=new Settingsite('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settingsite']))
			$model->attributes=$_GET['Settingsite'];
			
	

		$this->render('list',array(
			'model'=>$model, 
			
			
		));
	}
	
	
	
	
}
