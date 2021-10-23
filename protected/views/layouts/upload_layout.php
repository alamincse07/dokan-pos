<?php
/**
 * @var $this Controller
 */
?>
<html lang="en">
<head>
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta charset="utf-8">
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



?>



     <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="<?=$adminAssetsUrl?>/uploader-css/jquery.fileupload.css">
    <link rel="stylesheet" href="<?=$adminAssetsUrl?>/uploader-css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="<?=$adminAssetsUrl?>/uploader-css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?=$adminAssetsUrl?>/uploader-css/jquery.fileupload-ui-noscript.css"></noscript>
</head>
<body>

<input type="hidden" id="base_url" value="<?=Yii::app()->getBaseUrl(true)?>">



<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?=$adminAssetsUrl?>/uploader-js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?=$adminAssetsUrl?>/uploader-js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?=$adminAssetsUrl?>/uploader-js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?=$adminAssetsUrl?>/uploader-js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="<?=$adminAssetsUrl?>/uploader-js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?=$adminAssetsUrl?>/uploader-js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?=$adminAssetsUrl?>/uploader-js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?=$adminAssetsUrl?>/uploader-js/cors/jquery.xdr-transport.js"></script>
<![endif]-->










<div class="container">
    <?php
    $this->beginContent('application.views.layouts.admin-panels.body-header');
    $this->endContent();
    ?>


</div>


<div class="wrapper">
    <?php
    $this->beginContent('application.views.layouts.admin-panels.left-nav');
    $this->endContent();
    ?>
    <div class="page-content">
        <div class="content container">
            <?php
            if (Yii::app()->user->hasFlash('success'))
            {
                echo' <div class="col-lg-12">
                     <div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert"> <i class="icon-remove"></i> </button>
                        <h4> <i class="icon-ok-sign"></i> Success! </h4>
                        <p>'. Yii::app()->user->getFlash('success').'</p>
                      </div>

                  </div>';

            }
            /*$this->beginContent('application.views.layouts.admin-panels.header-content');
            $this->endContent();*/
            /*if(isset($this->breadcrumbs)):
                $this->widget('zii.widgets.CBreadcrumbs', array(
                     'links'=>$this->breadcrumbs,
                 ));//<!-- breadcrumbs -->
          endif;*/
            echo $content; ?>
        </div>
    </div>
</div>


<!--<div class="bottom-nav footer"> 2014 &copy; Thin Admin by Riaxe Systems. </div>-->

<!--System Script-->
<script type="text/javascript">
    sweetCore.activeMenu();
</script>
<!--End of System Script-->

<?php

echo '<script type="text/javascript">

jQuery(document).ready(function(){


 sweetCore.setCustomerList("'.$baseUrl.'/simpleAjax/BackOfficeCustomers");
});

  </script>';
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/sweetCore.js'.$this->assetVersion,CClientScript::POS_HEAD);


?>



















</body>
</html>
