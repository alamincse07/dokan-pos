<?php
/* @var $this SavingsController */
/* @var $model Savings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner'); ?>
		<?php echo $form->textField($model,'owner',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interval'); ?>
		<?php echo $form->textField($model,'interval'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rate'); ?>
		<?php echo $form->textField($model,'rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'opend_date'); ?>
		<?php echo $form->textField($model,'opend_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_taken'); ?>
		<?php echo $form->textField($model,'last_taken'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'next_date'); ?>
		<?php echo $form->textField($model,'next_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'period'); ?>
		<?php echo $form->textField($model,'period'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->