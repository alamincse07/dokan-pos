<?php
/**
 * @var $this Controller
 */
?>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$baseUrl = Yii::app()->request->baseUrl;
$adminAssetsUrl = "{$baseUrl}/admin-asset";
#custom library example
$cs = Yii::app()->clientScript;
?>
<link rel="icon" type="image/x-icon" href="<?=$baseUrl."/images/favicon.ico"?>" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
$cs->scriptMap = array(
    'jquery.js' => $adminAssetsUrl.'/js/jquery.js'.$this->assetVersion,
    'jquery.yii.js' => $adminAssetsUrl.'/js/jquery.js'.$this->assetVersion,
);

$cs->registerCoreScript('jquery');

$cs->registerCssFile($adminAssetsUrl.'/css/bootstrap.css'.$this->assetVersion, "screen");
$cs->registerCssFile($adminAssetsUrl.'/css/thin-admin.css'.$this->assetVersion, "screen");
$cs->registerCssFile($adminAssetsUrl.'/css/font-awesome.css'.$this->assetVersion, "screen");
$cs->registerCssFile($adminAssetsUrl.'/style/style.css'.$this->assetVersion);
$cs->registerCssFile($adminAssetsUrl.'/style/dashboard.css'.$this->assetVersion);
//$cs->registerCssFile($adminAssetsUrl.'/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'.$this->assetVersion,"screen");

$cs->registerCssFile($baseUrl . "/js/fancybox/jquery.fancybox.css" . $this->assetVersion);

#TODO:Too Many Jquery

$cs->registerScriptFile($adminAssetsUrl.'/js/jquery.inputmask.min.js'.$this->assetVersion,CClientScript::POS_END);

$cs->registerScriptFile($adminAssetsUrl.'/js/bootstrap.min.js'.$this->assetVersion,CClientScript::POS_END);
$cs->registerScriptFile($adminAssetsUrl.'/js/smooth-sliding-menu.js'.$this->assetVersion,CClientScript::POS_END);

#$cs->registerScriptFile($adminAssetsUrl.'/javascript/jquery191.min.js'.$this->assetVersion,CClientScript::POS_END);
$cs->registerScriptFile($adminAssetsUrl.'/javascript/jquery.jqplot.min.js'.$this->assetVersion,CClientScript::POS_END);
//$cs->registerScriptFile($adminAssetsUrl.'/js/select-checkbox.js'.$this->assetVersion,CClientScript::POS_END);
/*$cs->registerScriptFile($adminAssetsUrl.'/js/to-do-admin.js'.$this->assetVersion);
$cs->registerScriptFile($adminAssetsUrl.'/assets/sparkline/jquery.sparkline.js'.$this->assetVersion);
$cs->registerScriptFile($adminAssetsUrl.'/assets/sparkline/jquery.customSelect.min.js'.$this->assetVersion);
$cs->registerScriptFile($adminAssetsUrl.'/assets/sparkline/sparkline-chart.js'.$this->assetVersion);
$cs->registerScriptFile($adminAssetsUrl.'/assets/sparkline/easy-pie-chart.js'.$this->assetVersion);*/
$cs->registerScriptFile($baseUrl . '/js/fancybox/jquery.fancybox.js' . $this->assetVersion);

$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/sweetCore.js'.$this->assetVersion,CClientScript::POS_HEAD);

?>
<input type="hidden" id="base_url" value="<?=$baseUrl?>">
