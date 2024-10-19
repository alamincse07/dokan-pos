<?php
/* @var $this LabelsController */
/* @var $model Labels */

$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->id,
);

$this->menu=array(

	array('label'=>'Create Labels', 'url'=>array('create')),
	array('label'=>'Manage Labels', 'url'=>array('admin')),
);
?>

<h1>View Labels #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'label',
		'article_start',
	),
)); ?>
