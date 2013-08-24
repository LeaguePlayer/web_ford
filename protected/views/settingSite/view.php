<?php
$this->breadcrumbs=array(
	'Setting Sites'=>array('index'),
	$model->id,
);

<h1>View SettingSite #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'link_on_facebook',
		'link_on_vk',
		'link_on_twitter',
		'link_on_webcam',
		'email_main_admin',
		'email_test_drive',
		'email_feedback',
		'email_strahovanie',
		'email_service',
		'email_credit',
		'phone_code_city',
		'phone_sales',
		'phone_service',
		'street',
		'access_to_test_drive',
		'rows_stock_in_main',
		'status',
		'sort',
		'create_time',
		'update_time',
	),
)); ?>
