<?php
/* @var $this AreaNamesController */
/* @var $model AreaNames */

$this->breadcrumbs=array(
	'Area Names'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AreaNames', 'url'=>array('index')),
	array('label'=>'Create AreaNames', 'url'=>array('create')),
	array('label'=>'Update AreaNames', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AreaNames', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AreaNames', 'url'=>array('admin')),
);
?>

<h1>View AreaNames #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'area_name',
		'added_date',
	),
)); ?>
