

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'setting-site-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
	
		
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'fnc::returnDomains($data->id)',
			'filter'=>fnc::returnDomains()
		),
		
		
		array(
			'name'=>'update_time',
			'type'=>'raw',
			'value'=>'SiteHelper::russianDate($data->update_time).\' в \'.date(\'H:i\', $data->update_time)'
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
                   
		),
	),
)); ?>
