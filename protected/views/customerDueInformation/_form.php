<?php
/* @var $this CustomerDueInformationController */
/* @var $model CustomerDueInformation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-due-information-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'area_name'); ?>
		<?php echo $form->textField($model,'area_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'area_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'occupation'); ?>
		<?php echo $form->textField($model,'occupation',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'occupation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'articles'); ?>
		<?php echo $form->textField($model,'articles',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'articles'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->