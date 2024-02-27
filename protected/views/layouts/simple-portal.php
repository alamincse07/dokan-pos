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
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin-2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
   <script  type="text/javascript" src="<?=Yii::app()->request->baseUrl?>/js/jQuery/jquery-1.7.2.min.js"></script>
    <!--Jquery Library-->
    <script src="<?=Yii::app()->request->baseUrl?>/js/jQueryUI/jquery-ui-1.8.21.min.js" type="text/javascript"></script>

    <?php
    $baseUrl = Yii::app()->request->baseUrl;
    #custom library example
    $cs = Yii::app()->clientScript;
//    $cs->scriptMap = array(
//        'jquery.js' => $baseUrl.'/js/jquery-2.1.1.min.js',
//        'jquery.yii.js' => $baseUrl.'/js/jquery-2.1.1.min.js',
//    );
   // $cs->registerCoreScript('jquery');
   // $cs->registerScriptFile($baseUrl.'/js/jquery.min1.7.1.js'.$this->assetVersion);
    ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="content container-fluid" id="page1">
    <div class="row-fluid">
        <div class="widget">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <?php
            $visible= (Yii::app()->session['user_type'] ==1)?true:false;
            ?>
            <div id="mainmenu">
                <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('/site/index')),
                        array('label'=>'সঞ্চয়', 'url'=>array('/savings/admin'), 'visible'=>$visible),
                        array('label'=>'তোলার পরিমান', 'url'=>array('/savings/CheckBYDate'), 'visible'=>$visible),
                        array('label'=>'Graph', 'url'=>array('/dailySellInformation/ChartView'), 'visible'=>$visible),
                        array('label'=>'Monthly Graph', 'url'=>array('/dailySellInformation/ChartViewWeekly'), 'visible'=>$visible),
                        array('label'=>'Users', 'url'=>array('/member/admin'), 'visible'=>$visible),

                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                )); ?>
            </div><!-- mainmenu -->




            <div id="container">
                <?php

                if($visible){
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array('class'=>'operations1'),
                    ));
                }


                ?>
            </div><!-- sidebar -->
            <?php echo $content; ?>


            <div class="clear"></div>
<!--
            <div id="footer">
                Copyright &copy; <?php /*echo date('Y'); */?> by My Company.<br/>
                All Rights Reserved.<br/>
                <?php /*echo Yii::powered(); */?>
            </div><!-- footer -->

        </div>
    </div>
</div>

<style>
    #header{
        margin-bottom:150px;
    }
</style>
</body>
</html>
