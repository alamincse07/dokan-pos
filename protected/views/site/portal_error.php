<?php
/* @var $this SiteController */
/* @var $error array */
/**
 * @var $L Language
 */
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
</style>

<div class="errorSummary" style="display: none2;">
<?php echo CHtml::encode($message); ?>

</div>
<div class="wrapper contents_wrapper">

    <img src="<?=$baseUrl?>/images/404.png" alt="404" class="pages">

    <a href="<?=$this->createUrl('clientDashboard')?>" class="goBack simple_buttons">
        <?=$L->g('Go Back To Home Page')?>
    </a>

</div>