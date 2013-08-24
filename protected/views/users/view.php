<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_site',
		'login',
		'password',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
