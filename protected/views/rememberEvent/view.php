<?php
/* @var $this RememberEventController */
/* @var $model RememberEvent */

$this->breadcrumbs=array(
	'Remember Events'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RememberEvent', 'url'=>array('index')),
	array('label'=>'Create RememberEvent', 'url'=>array('create')),
	array('label'=>'Update RememberEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RememberEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RememberEvent', 'url'=>array('admin')),
);
?>

<h1>View RememberEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'notes',
		'date',
	),
)); ?>
