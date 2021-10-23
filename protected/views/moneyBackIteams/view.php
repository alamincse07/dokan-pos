<?php
/* @var $this MoneyBackIteamsController */
/* @var $model MoneyBackIteams */

$this->breadcrumbs=array(
	'Money Back Iteams'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MoneyBackIteams', 'url'=>array('index')),
	array('label'=>'Create MoneyBackIteams', 'url'=>array('create')),
	array('label'=>'Update MoneyBackIteams', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MoneyBackIteams', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MoneyBackIteams', 'url'=>array('admin')),
);
?>

<h1>View MoneyBackIteams #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'article',
		'amount',
		'manager',
		'date',
	),
)); ?>
