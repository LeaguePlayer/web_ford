<?php
$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->title,
);

<h1>View Menu #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_site',
		'id_category',
		'title',
		'link',
		'show_on_main',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
