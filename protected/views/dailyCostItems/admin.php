<?php
/* @var $this DailyCostItemsController */
/* @var $model DailyCostItems */

$this->breadcrumbs=array(
	'Daily Cost Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DailyCostItems', 'url'=>array('index')),
	array('label'=>'Create DailyCostItems', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('daily-cost-items-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Daily Cost Items</h1>


<?php $this->widget('MGridView', array(
	'id'=>'daily-cost-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'cost_type',
		'amount',
		'manager',
		'date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
