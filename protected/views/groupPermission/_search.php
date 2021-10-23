<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */
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
		<?php echo $form->label($model,'controller',array("class"=>'mws-form-label')); ?>
        <div class="mws-form-item">
		    <?php echo $form->textField($model,'controller',array("class"=>"medium")); ?>
        </div>
	</div>

	<div class="mws-form-row">
		<?php echo $form->label($model,'action',array("class"=>'mws-form-label')); ?>
        <div class="mws-form-item">
		    <?php echo $form->textField($model,'action',array("class"=>"medium")); ?>
        </div>
	</div>

	<div class="mws-form-row">
		<?php echo $form->label($model,'group_id',array("class"=>'mws-form-label')); ?>
        <div class="mws-form-item">
		    <?php echo $form->dropDownList($model,'group_id',UserGroup::model()->getUserGroupComboService(),array("class"=>"medium")); ?>
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
        <?php echo CHtml::submitButton('Search',array("name"=>'search',"class"=>"btn btn-primary")); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
        </div>
    </div>