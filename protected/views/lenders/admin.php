<?php
/* @var $this LendersController */
/* @var $model Lenders */

$this->breadcrumbs=array(
	'Lenders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lenders', 'url'=>array('index')),
	array('label'=>'Create Lenders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('lenders-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lenders</h1>



<?php $this->widget('MGridView', array(
	'id'=>'lenders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'date',
		'amount',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
