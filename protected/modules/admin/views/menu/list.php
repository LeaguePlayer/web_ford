<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'menu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		
		'id_category',
		'title',
		'link',
		'show_on_main',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Menu::getStatusAliases($data->status)',
			'filter'=>array(Menu::getStatusAliases())
		),
		'sort',
		array(
			'name'=>'create_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->create_time).\' в \'.date(\'H:i\', $data->create_time)'
		),
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', $data->update_time)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
