<?php
/* @var $this SavingsHistoryController */
/* @var $model SavingsHistory */
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
		<?php echo $form->label($model,'savings_id'); ?>
		<?php echo $form->textField($model,'savings_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pull_date'); ?>
		<?php echo $form->textField($model,'pull_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term'); ?>
		<?php echo $form->textField($model,'term'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->