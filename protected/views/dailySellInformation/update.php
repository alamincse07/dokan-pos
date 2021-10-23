<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */

$this->breadcrumbs=array(
	'Daily Sell Informations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DailySellInformation', 'url'=>array('index')),
	array('label'=>'Create DailySellInformation', 'url'=>array('create')),
	array('label'=>'View DailySellInformation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DailySellInformation', 'url'=>array('admin')),
);
?>

<h1>Update DailySellInformation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>