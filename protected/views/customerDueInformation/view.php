<?php
/* @var $this CustomerDueInformationController */
/* @var $model CustomerDueInformation */

$this->breadcrumbs=array(
	'Customer Due Informations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CustomerDueInformation', 'url'=>array('index')),
	array('label'=>'Create CustomerDueInformation', 'url'=>array('create')),
	array('label'=>'Update CustomerDueInformation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CustomerDueInformation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CustomerDueInformation', 'url'=>array('admin')),
);
?>

<h1>View CustomerDueInformation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'area_name',
		'occupation',
		'name',
		'articles',
		'amount',
		'manager',
		'date',
	),
)); ?>
