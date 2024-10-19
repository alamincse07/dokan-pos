<?php
/* @var $this LabelsController */
/* @var $model Labels */

$this->breadcrumbs=array(
	'Labels'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Create Labels', 'url'=>array('create')),
);
?>

<h1>Manage Labels</h1>

<?php $this->widget('MGridView', array(
	'id'=>'labels-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'label',
		'article_start',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
