<?php
/* @var $this SiteController */
/**
 * @var $L Language
 */
$L = $this::$L;
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	$L->g('About'),
);
?>
<h1><?=$L->g('About')?></h1>

<p><?=$L->g('This is a static page. You may change the content of this page by updating the file')?> <code><?php echo __FILE__; ?></code>.</p>
