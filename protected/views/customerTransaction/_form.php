<?php
/* @var $this CustomerTransactionController */
/* @var $model CustomerTransaction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-transaction-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_type'); ?>
		<?php echo $form->textField($model,'transaction_type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'transaction_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_due'); ?>
		<?php echo $form->textField($model,'total_due'); ?>
		<?php echo $form->error($model,'total_due'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->