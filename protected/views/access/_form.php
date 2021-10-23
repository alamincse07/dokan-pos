<?php
/* @var $this AccessController */
/* @var $model Access */
/* @var $form CActiveForm */
//$this->labels =GenericProperties::getCacheLabels();

//FOR LANGUAGE
$L = $this::$L;
?>
<div class="content container">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-header "><i class="icon-user"></i>

                    <h3>
                        <?php echo (($model->isNewRecord)?$L->g('Create Access'):$L->g('Update Access') .' '. $model->id); ?>

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
                        <p class="note"><?=$L->g('Fields with')?> <span class="required">*</span> <?=$L->g('are required.')?></p>
                        <?php echo $form->errorSummary($model); ?>
                        <div class="row"> <!--Second box-->
                            <div class="col-lg-6">
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model, 'user_id'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->dropDownList($model,'user_id',User::model()->getUserComboService(),array('class'=>'form-control required')); ?>
                                            <?php echo $form->error($model, 'user_id'); ?>
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
                                        $L->g("Manage Access"),
                                        $this->createUrl('access/admin'))?>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <?php echo CHtml::submitButton($model->isNewRecord ? $L->g('Create') : $L->g('Save'), array('class' => "btn btn-s-md btn-primary")); ?>

                                    <a class="btn-default btn" href="javascript:window.history.go(-1);"><?=$L->g('Cancel')?></a>
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

