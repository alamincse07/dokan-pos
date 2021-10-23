<?php
/* @var $this SavingsController */
/* @var $model Savings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'savings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'account_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'registration_no'); ?>
		<?php echo $form->textField($model,'registration_no',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'registration_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'owner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'interval'); ?>
		<?php echo $form->textField($model,'interval'); ?>
		<?php echo $form->error($model,'interval'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opend_date'); ?>
		<?php echo $form->textField($model,'opend_date'); ?>
		<?php echo $form->error($model,'opend_date'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'period'); ?>
		<?php echo $form->textField($model,'period'); ?>
		<?php echo $form->error($model,'period'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->