<?php
/* @var $this KormocariController */
/* @var $model Kormocari */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kormocari-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taken_date'); ?>
		<?php echo $form->textField($model,'taken_date'); ?>
		<?php echo $form->error($model,'taken_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'leave'); ?>
		<?php echo $form->textField($model,'leave'); ?>
		<?php echo $form->error($model,'leave'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manager'); ?>
		<?php echo $form->textField($model,'manager',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'manager'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->