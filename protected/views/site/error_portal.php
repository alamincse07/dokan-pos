<?php
/* @var $this SiteController */
/* @var $error array */
$L = $this::$L;
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    $L->g('Error'),
);
$baseUrl = Yii::app()->request->baseUrl;
?>

<style>
    .side_bar{
        display: none;
    }
    .error_code_img{
        text-align: center;
        font-size: 200px;
        color: #d1d1d1;
    }
</style>

<div class="errorSummary" style="display: none2;">
    <?php echo CHtml::encode($message); ?>

</div>
<div class="wrapper contents_wrapper">

    <div class="error_code_img">
        <?=@$code?>
    </div>
<!--    <img src="--><?//=$baseUrl?><!--/images/404.png" alt="404" class="pages">-->

    <a href="<?=$this->createUrl('/clientDashboard')?>" class="goBack simple_buttons">
        <?=$L->g('Go Back To Home Page')?>
    </a>

</div>