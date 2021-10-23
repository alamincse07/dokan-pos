<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'last-added-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'article'); ?>
		<?php echo $form->textField($model,'article',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'article'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>144)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'added_date'); ?>
		<?php echo $form->textField($model,'added_date'); ?>
		<?php echo $form->error($model,'added_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_pair'); ?>
		<?php echo $form->textField($model,'total_pair'); ?>
		<?php echo $form->error($model,'total_pair'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_taka'); ?>
		<?php echo $form->textField($model,'total_taka'); ?>
		<?php echo $form->error($model,'total_taka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actual_price'); ?>
		<?php echo $form->textField($model,'actual_price'); ?>
		<?php echo $form->error($model,'actual_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body_rate'); ?>
		<?php echo $form->textField($model,'body_rate'); ?>
		<?php echo $form->error($model,'body_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_added_pair'); ?>
		<?php echo $form->textField($model,'last_added_pair'); ?>
		<?php echo $form->error($model,'last_added_pair'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_added_taka'); ?>
		<?php echo $form->textField($model,'last_added_taka'); ?>
		<?php echo $form->error($model,'last_added_taka'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orginal_article'); ?>
		<?php echo $form->textField($model,'orginal_article',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'orginal_article'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->