<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 7/8/14
 * Time: 12:03 PM
 * @var $this Controller
 * @var $model User
 * @var $from CActiveForm
 */
/**
 * @var $L Language
 */
$L = $this::$L;
?>
<div class="form">
    <div><a class="js-multiple-upload-add" href="javascript:void(0)"><?=$L->g('Add')?></a></div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'multiple-upload-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
            'enctype' => 'multipart/form-data',
            'class'=>'js-multiple-upload-form'
        ),
    )); ?>

    <div class="row js-multiple-upload-field-container">
        <div>
            <?=$form->fileField($model, 'avatar',array('class'=>'js-multiple-upload-field'));?>
            <a href="javascript:void(0)" class="js-multiple-upload-delete">X</a>
        </div>
    </div>

    <div class="row">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("name"=>'save',"class"=>"js-form-submit-button")); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">

        sweetCore.uploadMultipleImage(".js-multiple-upload-form",
            ".js-multiple-upload-field", '.js-multiple-upload-field-container',
            '.js-multiple-upload-add', '.js-multiple-upload-delete');

</script>