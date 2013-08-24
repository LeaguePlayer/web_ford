<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cars-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->textFieldControlGroup($model,'name',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'image'); ?>
		<?php echo TbHtml::imageRounded($model->getThumb('medium')); ?><br>
		<?php echo $form->fileField($model,'image', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<?php echo $form->textFieldControlGroup($model,'price',array('class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'video1',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'video2',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'video3',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldControlGroup($model,'meta_title',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaControlGroup($model,'meta_keys',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaControlGroup($model,'meta_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'gallery'); ?>
		<?php if ($model->galleryManager->getGallery() === null) {
			echo '<p class="help-block">Прежде чем загружать изображения, нужно сохранить текущее состояние</p>';
		} else {
			$this->widget('admin_ext.imagesgallery.GalleryManager', array(
				'gallery' => $model->galleryManager->getGallery(),
				'controllerRoute' => '/admin/gallery',
			));
		} ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Cars::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
