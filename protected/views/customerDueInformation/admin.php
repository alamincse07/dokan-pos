<?php
/* @var $this CustomerDueInformationController */
/* @var $model CustomerDueInformation */

$this->breadcrumbs=array(
	'Customer Due Informations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CustomerDueInformation', 'url'=>array('index')),
	array('label'=>'Create CustomerDueInformation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-due-information-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$found = stristr(Yii::app()->request->url,'?show=true');

$visible = ($found)?true:false;
?>

<h1>Manage Customer Due Informations</h1>

<?php $this->widget('MGridView', array(
	'id'=>'customer-due-information-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'area_name',
		'occupation',
		'name',
		'articles',
		'amount',

		'manager',
		'date',

		array(
			'visible'=>$visible,
			'class'=>'CButtonColumn',
		),
	),
)); ?>
