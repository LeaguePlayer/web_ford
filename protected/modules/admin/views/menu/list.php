
<?php
$this->menu=array(
	array('label'=>'Добавить','url'=>array('create')),
);
?>
<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hotels-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php
    $str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#menu-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#menu-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('//admin/menu/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
    Yii::app()->clientScript->registerScript('sortable-project', $str_js);
?>




<h1>Управление <?php echo $model->translition(); ?></h1>





<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'menu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 'rowCssClassExpression'=>'"items[]_{$data->id}"',
	'type'=>TbHtml::GRID_TYPE_HOVER,
	'columns'=>array(
		
		
		
		array(
			'name'=>'id_category',
			'type'=>'raw',
			'value'=>'fnc::menuCategories($data->id_category)',
			'filter'=>fnc::menuCategories()
		),
		
		
		'title',
		'link',
		
		array(
			'name'=>'show_on_main',
			'type'=>'raw',
			'value'=>'fnc::returnYesNo($data->show_on_main)',
			'filter'=>fnc::returnYesNo()
		),
		
		
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>'Menu::getStatusAliases($data->status)',
			'filter'=>Menu::getStatusAliases()
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
			'template'=>'{update}{delete}',
		),
	),
)); ?>
