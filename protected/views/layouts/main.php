<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <?php
    $baseUrl = Yii::app()->request->baseUrl;
    #custom library example
    $cs = Yii::app()->clientScript;
    $cs->scriptMap = array(
        'jquery.js' => $baseUrl.'/js/jquery.min1.7.1.js',
        //'jquery.yii.js' => $baseUrl.'/js/jquery-2.1.1.min.js',
    );
    $cs->registerCoreScript('jquery');
    $cs->registerCssFile($baseUrl.'/css/sexy-combo.css');
    $cs->registerCssFile($baseUrl.'/css/sexy.css');
    $cs->registerCssFile($baseUrl.'/css/easy-responsive-tabs.css');
    $cs->registerCssFile($baseUrl.'/js/themes/dot-luv/jquery-ui.custom.css');
    $cs->registerCssFile($baseUrl.'/css/style.css');
    $cs->registerCssFile($baseUrl.'/js/chosen.min.css');

    $cs->registerScriptFile($baseUrl.'/js/jquery.sexy-combo-2.1.2.pack.js'.$this->assetVersion);
    $cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.9.0.custom.js'.$this->assetVersion);
    $cs->registerScriptFile($baseUrl.'/js/easyResponsiveTabs.js'.$this->assetVersion);
    $cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js'.$this->assetVersion);
    $cs->registerScriptFile($baseUrl.'/js/dokan.js'.$this->assetVersion);
    ?>
    <script type="text/javascript">
        var SITE_URL='<?=Yii::app()->request->baseUrl?>/';
    </script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="content container" id="page">
    <div class="row">
        <?= $content?>
    </div>
</div>

</body>
</html>
