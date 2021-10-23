<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

// FOR LANGUAGE
$L=$this::$L;
?>

<!--<div class="wide form">-->
<div class="clear"></div>
<div class="mws-panel grid_8">
    <div class="mws-panel-header"><span><?=$L->g('Advanced Search')?></span>
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

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'username',array("class"=>'mws-form-label')); ?>
            <div class="mws-form-item">
            <?php echo $form->textField($model,'username',array("class"=>"medium")); ?>
            </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'full_name',array("class"=>'mws-form-label')); ?>
          <div class="mws-form-item">
            <?php echo $form->textField($model,'full_name',array("class"=>"medium")); ?>
          </div>

        </div>

        <div class="mws-form-row">
            <?php echo $form->label($model,'email',array("class"=>'mws-form-label')); ?>
          <div class="mws-form-item">
            <?php echo $form->textField($model,'email',array("class"=>"medium")); ?>
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

        <div class="mws-button-row" style="margin-top: 50px;">
            <?php echo CHtml::submitButton('Search',array("name"=>'save',"class"=>"btn btn-primary")); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- search-form -->
    </div>
</div>
<div class="clear"></div>