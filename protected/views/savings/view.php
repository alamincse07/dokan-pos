<?php
/* @var $this SavingsController */
/* @var $model Savings */

$this->menu=array(
    array('label'=>'List Savings', 'url'=>array('index')),
    array('label'=>'Manage Savings', 'url'=>array('admin')),
);
?>
<style>

    div.form .row {
        background: none repeat scroll 0 0 #462669;
        border: 1px solid;
        color: #fff000;
        display: inline-block;
        font-weight: bolder;
        margin: 10px 20px;
        min-width: 270px;
        padding: 15px;
    }
    .taken{
        color: #3bce0a;
     }
    .chk{
        margin-left: 40px !important;
    }
</style>


<h1>View Savings history </h1>


<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'savings-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>


    <?php

    foreach($model as $k=>$val){

        $k=$k+1;
        if($val['status']==1){
            $text=' <span class="taken">Already Taken</span>';
        }else{
            $text='<input type="checkbox" class="chk" name="savings_history['.$k.']" value="1">';
            if($val['pull_able']==2){

                $text='';
            }

        }
        //$text=' Already Taken';


        $prefix=($k==1)?'st':($k==2)?'nd':($k==3)?'rd':'th';
    ?>

        <div class="row label">
            <?php echo 'Pull Date : '.$val['pull_date'].' ( '.$k.$prefix.' )' ?>
            <?php echo $text; ?>

        </div>

    <?php


    }

    ?>


    <div class="buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
