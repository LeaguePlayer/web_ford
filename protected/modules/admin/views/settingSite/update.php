<?php
$this->breadcrumbs=array(
	"{$model->translition()}"=>array('list'),
	'Редактирование',
);


?>

<h1><?php echo $model->translition(); ?> - Редактирование</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>