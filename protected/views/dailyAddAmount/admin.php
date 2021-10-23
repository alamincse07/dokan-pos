<?php
/* @var $this DailyAddAmountController */
/* @var $model DailyAddAmount */

$this->breadcrumbs=array(
	'Daily Add Amounts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DailyAddAmount', 'url'=>array('index')),
	array('label'=>'Create DailyAddAmount', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('daily-add-amount-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Daily Add Amounts</h1>

<?php $this->widget('MGridView', array(
	'id'=>'daily-add-amount-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',

		'name',
        'category',
        'amount',
        'date',
		'taken_by',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
