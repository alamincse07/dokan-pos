<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */

$this->breadcrumbs=array(
	'Last Added Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LastAddedItems', 'url'=>array('index')),
	array('label'=>'Create LastAddedItems', 'url'=>array('create')),
	array('label'=>'Update LastAddedItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LastAddedItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LastAddedItems', 'url'=>array('admin')),
);
?>

<h1>View LastAddedItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'article',
		'category',
		'added_date',
		'total_pair',
		'total_taka',
		'actual_price',
		'body_rate',
		'last_added_pair',
		'last_added_taka',
		'orginal_article',
	),
)); ?>
