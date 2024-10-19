<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Update Articles', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Articles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>View Articles #<?php echo $model->id; ?></h1>

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
		'tags',
		'increment',
	),
)); ?>
