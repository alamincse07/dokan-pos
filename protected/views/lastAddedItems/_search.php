<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */
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
		<?php echo $form->label($model,'article'); ?>
		<?php echo $form->textField($model,'article',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>144)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added_date'); ?>
		<?php echo $form->textField($model,'added_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_pair'); ?>
		<?php echo $form->textField($model,'total_pair'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_taka'); ?>
		<?php echo $form->textField($model,'total_taka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actual_price'); ?>
		<?php echo $form->textField($model,'actual_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'body_rate'); ?>
		<?php echo $form->textField($model,'body_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_added_pair'); ?>
		<?php echo $form->textField($model,'last_added_pair'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_added_taka'); ?>
		<?php echo $form->textField($model,'last_added_taka'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orginal_article'); ?>
		<?php echo $form->textField($model,'orginal_article',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->