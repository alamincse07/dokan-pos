<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

// FOR LANGUAGE
$L=$this::$L;

?>
<div class="content container">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-header "> <i class="icon-user"></i>
                   <h3>
                <?php if(isset($model->id)){?>
                    <?php echo $L->g('Update User').' '. $model->id;
                 }else{
                    echo $L->g('Create User') ;
                } ?>
                    </h3>
                  </div>

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'user-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'enctype' => 'multipart/form-data',
                        'class'=>'mws-form'
                ))); ?>
                <div class="widget-content">
                    <div class="panel-body">
                        <p class="note"><?=$L->g('Fields with')?><span class="required">*</span> <?=$L->g('are required.')?></p>

                        <!--	--><?php echo $form->errorSummary($model); ?>
                        <div class="row"> <!--Second box-->
                            <div class="col-lg-6">
                                <div class="control-group display_none">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'username'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <?php echo $form->textField($model, 'username',array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model,'username'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'password'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <?php echo $form->textField($model, 'password',array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model,'password'); ?>
                                    </div>
                                    </div>


                                </div>
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'first_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <?php echo $form->textField($model, 'first_name',array('class' => 'form-control')); ?>
                                        <?php echo $form->error($model,'first_name'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'last_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <?php echo $form->textField($model,'last_name',array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'last_name'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'email'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                                            <?php echo $form->error($model,'email'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'avatar'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if(strlen($model->avatar)<5): ?>
                                            <?php echo $form->fileField($model, 'avatar', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'avatar'); ?>
                                            <?php else: ?>
                                                <?=CHtml::link(
                                                    $L->g($model->avatar),
                                                    $this->createUrl(Generic::GetUploadedFilePath($model, 'avatar',Yii::app()->controller->id)));?>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="control-group">
                                    <div style="float: right">
                                        <?=CHtml::link(
                                            $L->g("Manage User"),
                                            $this->createUrl('user/admin'))?>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? $L->g('Create') : $L->g('Save'),array('class'=>"btn btn-s-md btn-primary")); ?>

                                    <!--<button onclick="javascript:$('#validate-form').parsley( 'validate' );"
                                            class="btn-primary btn">Submit
                                    </button>-->
                                    <button class="btn-default btn"><?=$L->g('Cancel')?></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php $this->endWidget(); ?>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		//$(".fileinput-holder").css('width','268px');
		$(".fileinput-preview").css("width",'236px');
		$(".fileinput-btn.btn").css('right','235px');
	});
</script>