<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'staticpage-form',
	'enableAjaxValidation'=>false,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($model);?>

	<?php echo $form->groupSitesControlGroup($model, 'id_site', "Показывать на сайтах"); ?>

	<?php echo $form->textFieldControlGroup($model,'title',array('class'=>'span8','maxlength'=>255)); ?>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'html_content'); ?>
		<?php $this->widget('admin_ext.ckeditor.CKEditorWidget', array('model' => $model, 'attribute' => 'html_content',
		)); ?>
		<?php echo $form->error($model, 'html_content'); ?>
	</div>

	<div class='control-group'>
		<?php echo CHtml::activeLabelEx($model, 'image'); ?>
		<?php echo TbHtml::imageRounded($model->getThumb('medium')); ?><br>
		<?php echo $form->fileField($model,'image', array('class'=>'span8')); ?>
		<?php echo $form->error($model, 'image'); ?>
	</div>

	<?php echo $form->dropDownListControlGroup($model, 'status', Staticpage::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	
    <fieldset>
    	<legend>ДЛЯ SEO-СПЕЦИАЛИСТА</legend>
        
        <?php echo $form->textFieldControlGroup($model,'meta_alias',array('class'=>'span8','maxlength'=>255)); ?>
        
        <?php echo $form->textFieldControlGroup($model,'meta_title',array('class'=>'span8','maxlength'=>255)); ?>

		<?php echo $form->textAreaControlGroup($model,'meta_keys',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textAreaControlGroup($model,'meta_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    </fieldset>
    

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
