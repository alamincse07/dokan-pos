<?php
/* @var $this CustomerOccupationController */
/* @var $model CustomerOccupation */

$this->breadcrumbs=array(
	'Customer Occupations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CustomerOccupation', 'url'=>array('index')),
	array('label'=>'Create CustomerOccupation', 'url'=>array('create')),
);


?>

<h1>Manage Customer Occupations</h1>

<?php $this->widget('MGridView', array(
	'id'=>'customer-occupation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'occupation',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
