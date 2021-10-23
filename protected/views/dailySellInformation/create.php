<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */

$this->breadcrumbs=array(
	'Daily Sell Informations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DailySellInformation', 'url'=>array('index')),
	array('label'=>'Manage DailySellInformation', 'url'=>array('admin')),
);
?>

<h1>Create DailySellInformation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>