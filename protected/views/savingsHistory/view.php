<?php
/* @var $this SavingsHistoryController */
/* @var $model SavingsHistory */

$this->breadcrumbs=array(
	'Savings Histories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SavingsHistory', 'url'=>array('index')),
	array('label'=>'Create SavingsHistory', 'url'=>array('create')),
	array('label'=>'Update SavingsHistory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SavingsHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SavingsHistory', 'url'=>array('admin')),
);
?>

<h1>View SavingsHistory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'savings_id',
		'pull_date',
		'term',
		'status',
	),
)); ?>
