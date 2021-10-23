<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'daily-sell-information-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article'); ?>
		<?php echo $form->textField($model,'article',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'article'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->textField($model,'color',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager'); ?>
		<?php echo $form->textField($model,'manager',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'manager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sells_man'); ?>
		<?php echo $form->textField($model,'sells_man',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'sells_man'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profit'); ?>
		<?php echo $form->textField($model,'profit',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'profit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->