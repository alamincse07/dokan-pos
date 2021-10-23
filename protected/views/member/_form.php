<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'member_name'); ?>
		<?php echo $form->textField($model,'member_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'member_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_password'); ?>
		<?php echo $form->textField($model,'member_password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'member_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_type'); ?>
		<?php echo $form->textField($model,'member_type'); ?>
		<?php echo $form->error($model,'member_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->