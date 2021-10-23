
<?php
/**
 * Created by Sunny
 * User: Computer Source
 * Date: 10/1/14
 * Time: 10:45 AM
 */
/* @var $this UserController */
/* @var $user_model User */
/* @var $form CActiveForm */
/**
 * @var $L Language
 */
$L = $this::$L;
$Config = new Config();

$L = $this::$L;
$this->breadcrumbs=array(
    //$L->g('Super Amdin')=>array('admin'),
    $L->g('Settings'),
);
?>
<div class="setting_message">
    <h3>After Settings Change, Please Login Again.</h3>
</div>
<div class="widget-header12 ">
    <ul class="nav nav-tabs" id="myTabright">
        <li class="active"><a data-toggle="tab" href="javascript:void(0);"><?=$L->g('Super Admin Settings')?></a></li>

    </ul>
</div>

<div class="content container">
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'client-advisors-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                        'enctype' => 'multipart/form-data',
                    ),
                )); ?>
                <div class="widget-content">
                    <div class="panel-body">

                        <p class="note"><?=$L->g('Fields with')?> <span class="required">*</span><?=$L->g(' are required.')?></p>

                        <?php echo $form->errorSummary($user_model); ?>

                        <div class="row"> <!--First Box-->

                            <div class="col-lg-6">

                                <!--<div class="control-group display_none">
                                    <div class="col-md-6">
                                        <?php /*echo $form->labelEx($model,'client_id'); */?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php /*echo $form->textField($model,'client_id',array('class' => 'form-control')); */?>
                                            <?php /*echo $form->error($model,'client_id'); */?>
                                        </div>
                                    </div>

                                </div>-->
                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($user_model,'username'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($user_model,'username',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($user_model,'username'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($user_model,'last_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($user_model,'last_name',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($user_model,'last_name'); ?>
                                        </div>
                                    </div>

                                </div>





                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($user_model,'password'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->passwordField($user_model,'password',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($user_model,'password'); ?>
                                        </div>
                                    </div>

                                </div>

                                <!--<div class="control-group">
                                    <div class="col-md-6">
                                        <?php /*echo $form->labelEx($user_model,'avatar'); */?>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <?php /*$class_name=(strlen($user_model->avatar)<5)?'':'display_none'; */?>
                                            <div class="js_file <?/*=$class_name*/?> ">
                                                <?php /*echo $form->fileField($user_model, 'avatar',array('class' => 'form-control '.$class_name)); */?>
                                                <?php /*echo $form->error($user_model,'avatar'); */?>
                                            </div>
                                            <?php /*if($class_name!=''): */?>
                                                <?/*=CHtml::image(Yii::app()->request->baseUrl."/".$Config->profile_image_path.$user_model->avatar, $user_model->email,array("width"=>70))*/?>
                                                <?php /*echo CHtml::button('Change',array('class'=>'js_file_upload btn btn-xs btn-info','onClick'=>'sweetCore.ChangeFile(this);')); */?>
                                            <?php /*endif; */?>
                                        </div>
                                    </div>

                                </div>-->

                                <!--<div class="control-group ">
                                    <div class="col-md-6">
                                        <?php /*echo $form->labelEx($model,'insertion'); */?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php /*echo $form->textField($model,'insertion',array('class' => 'form-control')); */?>
                                            <?php /*echo $form->error($model,'insertion'); */?>
                                        </div>
                                    </div>

                                </div>-->

                            </div>
                            <div class="col-lg-6">


                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($user_model,'first_name'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($user_model,'first_name',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($user_model,'first_name'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="control-group">
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($user_model,'email'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo $form->textField($user_model,'email',array('class' => 'form-control')); ?>
                                            <?php echo $form->error($user_model,'email'); ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-9">
                                <div class="btn-toolbar">
                                    <?php echo CHtml::submitButton($user_model->isNewRecord ?$L->g('Create')  : $L->g('Save'),array('class'=>"btn btn-s-md btn-primary")); ?>

                                    <a class="btn-default btn" href="javascript:window.history.go(-1);"><?=$L->g('Cancel')?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->endWidget(); ?>

            </div></div></div><!-- form -->
</div>

