<?php
/* @var $this LendersController */
/* @var $model Lenders */

$this->breadcrumbs=array(
	'Lenders'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Lenders', 'url'=>array('index')),
	array('label'=>'Create Lenders', 'url'=>array('create')),
	array('label'=>'Update Lenders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lenders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lenders', 'url'=>array('admin')),
);
?>

<h1>View Lenders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'date',
		'amount',
	),
)); ?>
