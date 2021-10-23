<?php
/* @var $this DueInformationController */
/* @var $model DueInformation */

$this->breadcrumbs=array(
	'Due Informations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DueInformation', 'url'=>array('index')),
	array('label'=>'Create DueInformation', 'url'=>array('create')),
	array('label'=>'Update DueInformation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DueInformation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DueInformation', 'url'=>array('admin')),
);
?>

<h1>View DueInformation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'area_name',
		'occupation',
		'customer_name',
		'product',
		'price',
		'added_date',
	),
)); ?>
