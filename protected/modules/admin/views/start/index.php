

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'settings-form',
	'layout'=>TbHtml::FORM_LAYOUT_INLINE,
	'enableAjaxValidation'=>false,
)); ?>

	<?php if ( count($settings) > 0 ): ?>
	<?php foreach ($settings as $setting): ?>
		<div class="control-group">
			<label class="control-label" for="<?=$setting->option?>"><?=$setting->label?></label>
			<div class="controls">
				<?php if ( $setting->type == 'select' ): ?>
                    <?php
                        $rangeData = unserialize($setting->ranges);
                        if ( !is_array($rangeData) ) {
                            $rangeData = array();
                        }
                    ?>
					<?php echo TbHtml::dropDownList("Settings[{$setting->option}]", "{$setting->value}", $rangeData, array(
						'class'=>'span3',
						'displaySize'=>1,
						'empty'=>'Не задано',
					)); ?>
				<?php else: ?>
					<input class="span3" maxlength="256" name="Settings[<?=$setting->option?>]" id="<?=$setting->option?>" value="<?=$setting->value?>" type="text">
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
	<?php endif; ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Сохранить',
		)); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
			'type'=>'primary',
			'label'=>'Сброс',
		)); ?>
	</div>

<?php $this->endWidget(); ?>