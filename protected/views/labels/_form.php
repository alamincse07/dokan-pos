<?php
/* @var $this LabelsController */
/* @var $model Labels */
/* @var $form CActiveForm */
?>



<div class="row flex">


<?php 
  echo $this->renderPartial('../elements/label-builder', ['action'=>'Set']);
?>



<div class="col-4 form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'labels-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">← আগে নাম সেট কোরো </p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'label'); ?>
		<?php echo $form->textField($model,'label',array('size'=>60,'maxlength'=>255, 'readonly'=>true)); ?>
		<?php echo $form->error($model,'label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_start'); ?>
		<?php echo $form->textField($model,'article_start'); ?>
		<?php echo $form->error($model,'article_start'); ?>
	</div>

	<div id="formBtn" class="row buttons <?php if($model->isNewRecord) echo 'd-none'; ?>">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>

<style>



.tagslist{
	flex-grow: 0;
}

    
    .btn.btn-info {
        background: coral;
        padding: 10px;
        font-size: 16px;
    }

    span#art_list {
        float: right;
    }
    div.sexy {
        border: 0 none;
        height: 21px;
        margin: 0;
        padding: 0;
        white-space: nowrap;
        width: 220px;
        float: right;
    }
    .new_generate_article{
        color: #ffff00;
    }
    .big{
        background-color: #ff5bd1 !important;
    }
	.single-or{
	
	text-align:center;
	color:yellow;
	}
    span#print_count{
        background:Black;
        padding:3px;
        color:#FFF;
    }
   
</style>


    <script>
    
	  function SetName(){
		  var name = $("#slogan-box").text();
          var slogan = name.trim().replace(/×/g,  ' ').trim();
			$('#Labels_label').val(slogan);
            if(slogan.length > 0){

                $('#formBtn').removeClass('d-none');
            }
		}
    </script>