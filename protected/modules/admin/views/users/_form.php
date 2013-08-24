
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model);?>

	
    
    <?php echo $form->groupSitesControlGroup($model, 'id_site', "Права доступа для сайтов"); ?>

	<?php echo $form->textFieldControlGroup($model,'login',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->passwordFieldControlGroup($model,'password',array('class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->dropDownListControlGroup($model, 'status', Users::getStatusAliases(), array('class'=>'span8', 'displaySize'=>1)); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
