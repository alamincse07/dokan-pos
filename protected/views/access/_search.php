<?php
/* @var $this AccessController */
/* @var $model Access */
/* @var $form CActiveForm */
//FOR LANGUAGE
$L = $this::$L;
?>

<div class="clear"></div>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><?=$L->g('Advanced Search')?></span>
    </div>
    <div class="mws-panel-body" style="height: auto">
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
                <?php echo $form->error($model,'id'); ?>
            </div>

            <div class="mws-form-row">
                <?php echo $form->label($model,'user_id',array("class"=>'mws-form-label')); ?>
                <div class="mws-form-item">
                    <?php echo $form->dropDownList($model,'user_id',User::model()->getUserComboService(),array("class"=>"medium")); ?>
                </div>
                <?php echo $form->error($model,'user_id'); ?>
            </div>

            <div class="mws-form-row">
                <?php echo $form->label($model,'group_id',array("class"=>'mws-form-label')); ?>
                <div class="mws-form-item">
                    <?php echo $form->dropDownList($model,'group_id',UserGroup::model()->getUserGroupComboService(),array("class"=>"medium")); ?>
                </div>
                <?php echo $form->error($model,'group_id'); ?>
            </div>

            <div class="mws-button-row" style="margin-top: 50px;">
                <?php echo CHtml::submitButton('Search',array("name"=>'search',"class"=>"btn btn-primary")); ?>
            </div>

        <?php $this->endWidget(); ?>

        </div><!-- search-form -->
   </div>
</div>