<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>

<h1>Управление <?php echo $model->translition(); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'staticpage-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		'title',
		array(
			'header'=>'Фото',
			'type'=>'raw',
			'value'=>'TbHtml::imageRounded($data->getThumb("small"))'
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Staticpage::getStatusAliases($data->status)',
			'filter'=>array(Staticpage::getStatusAliases())
		),
		
	
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
			'template'=>'{cash} {update} {delete}',
                    'buttons'=>array
                    (
                        'cash' => array
                        (
                            
							'label'=>'<i class="icon-add-menu"></i>',
							'options'=>array('title'=>"Добавить пункт меню с ссылкой на эту страницу"),
                            //'imageUrl'=>Yii::app()->request->baseUrl.'/media/images/cloud.png',
                            'url'=>'Yii::app()->createUrl("/admin/menu/create", array("page"=>$data->id))',
                        ),
						
                        
                    ),
		),
		
	
	),
)); ?>
