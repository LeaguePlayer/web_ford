<?php
/* @var $this SettingSiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Setting Sites',
);

$this->menu=array(
	array('label'=>'Create SettingSite', 'url'=>array('create')),
	array('label'=>'Manage SettingSite', 'url'=>array('admin')),
);
?>

<h1>Setting Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
