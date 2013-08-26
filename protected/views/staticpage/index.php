<?php
/* @var $this StaticpageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Staticpages',
);

$this->menu=array(
	array('label'=>'Create Staticpage', 'url'=>array('create')),
	array('label'=>'Manage Staticpage', 'url'=>array('admin')),
);
?>

<h1>Staticpages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
