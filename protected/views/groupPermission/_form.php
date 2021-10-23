<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */
/* @var $form CActiveForm */
//$this->labels =GenericProperties::getCacheLabels();
/**
 * @var $L Language
 */
$L = $this::$L;
?>
<div class="content container">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-header "><i class="icon-user"></i>

                    <h3>
                      <?php echo (($model->isNewRecord)? $L->g('Create Group Permission'):$L->g('Update Group Permission').' '.$model->id); ?>

                    </h3>
                </div>

                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                        'class' => 'mws-form'
                    ))); ?>
                <div class="widget-content">
                    <div class="panel-body">
                        <p class="note"><?=$L->g('Fields with')?> <span class="required">*</span><?=$L->g(' are required.')?></p>
                        <p class="note"><?=$L->g(' Just put a * (star) for give permission to all available page under any module')?></p>
                        <?php echo $form->errorSummary($model); ?>
                        <div class="row"> <!--Second box-->
                            <div class="col-lg-6">
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'controller'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->dropDownList($model,'controller',Enum::getControllers(),array('class'=>'form-control required')); ?>
                                            <?php echo $form->error($model, 'controller'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'action'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($model, 'action',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model,'action'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="control-group">

                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'group_id'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->dropDownList($model,'group_id',UserGroup::model()->getUserGroupComboService(),array('class'=>'form-control required')); ?>
                                            <?php echo $form->error($model, 'group_id'); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div style="float: right">
                                    <?=
                                    CHtml::link(
                                        $L->g("Manage GroupPermission"),
                                        $this->createUrl('groupPermission/admin'))?>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-9">
                                <div class="btn-toolbar">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? $L->g('Create') : $L->g('Save'), array('class' => "btn btn-s-md btn-primary")); ?>

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


