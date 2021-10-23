<?php
/* @var $this CustomerOccupationController */
/* @var $model CustomerOccupation */

$this->breadcrumbs=array(
	'Customer Occupations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CustomerOccupation', 'url'=>array('index')),
	array('label'=>'Create CustomerOccupation', 'url'=>array('create')),
	array('label'=>'Update CustomerOccupation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CustomerOccupation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustomerOccupation', 'url'=>array('admin')),
);
?>

<h1>View CustomerOccupation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'occupation',
	),
)); ?>
