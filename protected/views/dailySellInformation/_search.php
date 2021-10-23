<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */
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
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article'); ?>
		<?php echo $form->textField($model,'article',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'color'); ?>
		<?php echo $form->textField($model,'color',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'manager'); ?>
		<?php echo $form->textField($model,'manager',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sells_man'); ?>
		<?php echo $form->textField($model,'sells_man',array('size'=>55,'maxlength'=>55)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profit'); ?>
		<?php echo $form->textField($model,'profit',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->