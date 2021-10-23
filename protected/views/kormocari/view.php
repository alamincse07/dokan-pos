<?php
/* @var $this KormocariController */
/* @var $model Kormocari */

$this->breadcrumbs=array(
	'Kormocaris'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Kormocari', 'url'=>array('index')),
	array('label'=>'Create Kormocari', 'url'=>array('create')),
	array('label'=>'Update Kormocari', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kormocari', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kormocari', 'url'=>array('admin')),
);
?>

<h1>View Kormocari #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'taken_date',
		'leave',
		'amount',
		'manager',
	),
)); ?>
