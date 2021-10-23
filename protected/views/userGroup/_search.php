<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
/* @var $form CActiveForm */
/**
 * @var $L Language
 */
$L = $this::$L;
?>
<div class="clear"></div>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><?=$L->g('Advanced Search')?></span>
    </div>
    <div class="mws-panel-body" style="auto">
        <div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'htmlOptions'=>array(
            'class'=>'mws-form',
            'enctype'=>'multipart/form-data',
        ),
    )); ?>

        <div class="mws-form-row">
            <?php echo $form->label($model,'id',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
                <?php echo $form->textField($model,'id',array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'group',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
                <?php echo $form->textField($model,'group',array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'create_date',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
                <?php echo $form->textField($model,'create_date',array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'update_date',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
                <?php echo $form->textField($model,'update_date',array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'active',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
                <?php echo $form->dropDownList($model,'active',Enum::yesNo(),array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-button-row" style="margin-top: 50px;">
            <?php echo CHtml::submitButton('Search',array("name"=>'search',"class"=>"btn btn-primary")); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- search-form -->
    </div>
</div>