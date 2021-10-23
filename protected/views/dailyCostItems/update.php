<?php
/* @var $this DailyCostItemsController */
/* @var $model DailyCostItems */

$this->breadcrumbs=array(
	'Daily Cost Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DailyCostItems', 'url'=>array('index')),
	array('label'=>'Create DailyCostItems', 'url'=>array('create')),
	array('label'=>'View DailyCostItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DailyCostItems', 'url'=>array('admin')),
);
?>

<h1>Update DailyCostItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>