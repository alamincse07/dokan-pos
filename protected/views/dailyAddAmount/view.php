<?php
/* @var $this DailyAddAmountController */
/* @var $model DailyAddAmount */

$this->breadcrumbs=array(
	'Daily Add Amounts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List DailyAddAmount', 'url'=>array('index')),
	array('label'=>'Create DailyAddAmount', 'url'=>array('create')),
	array('label'=>'Update DailyAddAmount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DailyAddAmount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DailyAddAmount', 'url'=>array('admin')),
);
?>

<h1>View DailyAddAmount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'amount',
		'date',
		'name',
		'taken_by',
	),
)); ?>
