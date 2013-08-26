<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->title,
);

<h1>View News #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_type',
		'title',
		'html_content',
		'id_car',
		'image',
		'super_img',
		'super_title',
		'super_short_desc',
		'super_full_desc',
		'super_work_to',
		'meta_title',
		'meta_keys',
		'meta_desc',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
