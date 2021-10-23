<?php
/* @var $this SavingsHistoryController */
/* @var $model SavingsHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'savings-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'savings_id'); ?>
		<?php echo $form->textField($model,'savings_id'); ?>
		<?php echo $form->error($model,'savings_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pull_date'); ?>
		<?php echo $form->textField($model,'pull_date'); ?>
		<?php echo $form->error($model,'pull_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term'); ?>
		<?php echo $form->textField($model,'term'); ?>
		<?php echo $form->error($model,'term'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->