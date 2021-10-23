<?php
/* @var $this DailyCostItemsController */
/* @var $model DailyCostItems */

$this->breadcrumbs=array(
	'Daily Cost Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DailyCostItems', 'url'=>array('index')),
	array('label'=>'Create DailyCostItems', 'url'=>array('create')),
	array('label'=>'Update DailyCostItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DailyCostItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DailyCostItems', 'url'=>array('admin')),
);
?>

<h1>View DailyCostItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cost_type',
		'amount',
		'manager',
		'date',
	),
)); ?>
