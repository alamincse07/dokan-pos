<?php
/* @var $this DailyCostItemsController */
/* @var $model DailyCostItems */

$this->breadcrumbs=array(
	'Daily Cost Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DailyCostItems', 'url'=>array('index')),
	array('label'=>'Manage DailyCostItems', 'url'=>array('admin')),
);
?>

<h1>Create DailyCostItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>