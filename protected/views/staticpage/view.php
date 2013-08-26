<?php
$this->breadcrumbs=array(
	'Staticpages'=>array('index'),
	$model->title,
);

<h1>View Staticpage #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'html_content',
		'image',
		'status',
		'meta_title',
		'meta_keys',
		'meta_desc',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
