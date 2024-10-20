<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
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
		<?php echo $form->labelEx($model,'orginal_article'); ?>

		<?php echo $form->dropDownList($model,'orginal_article', Generic::getLabels(true), array('size'=>1,'maxlength'=>255)); ?>
		
		<?php echo $form->error($model,'orginal_article'); ?>
	</div>

	<?php
	if(@Yii::app()->session['user_type']!==1){ ?>
	 <div class="row d-none">
	 <?php } ?>
	 
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
		<?php echo $form->textField($model,'actual_price',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->labelEx($model,'increment'); ?>
		<?php echo $form->textField($model,'increment',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'increment'); ?>
	</div>

	
	<?php if(@Yii::app()->session['user_type']!==1){ ?>
	</div>
	 <?php } ?>

	 <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->