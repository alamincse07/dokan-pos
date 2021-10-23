<?php
/* @var $this CustomerTransactionController */
/* @var $model CustomerTransaction */

$this->breadcrumbs=array(
	'Customer Transactions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CustomerTransaction', 'url'=>array('index')),
	array('label'=>'Create CustomerTransaction', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-transaction-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Customer Transactions</h1>
<?php 


$found = stristr(Yii::app()->request->url,'?show=true');

$visible = ($found)?true:false;

$this->widget('MGridView', array(
	'id'=>'customer-transaction-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'date',
		'transaction_type',
		'amount',
		'total_due',
		'customer_id',
		array(
			'visible'=>$visible,
			'class'=>'CButtonColumn',
		),
	),
)); ?>
