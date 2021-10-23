<?php
/* @var $this CostItemsController */
/* @var $model CostItems */

$this->breadcrumbs=array(
	'Cost Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CostItems', 'url'=>array('index')),
	array('label'=>'Create CostItems', 'url'=>array('create')),
	array('label'=>'Update CostItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CostItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CostItems', 'url'=>array('admin')),
);
?>

<h1>View CostItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cost_name',
		'date',
		'cost_type',
	),
)); ?>
