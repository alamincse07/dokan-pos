<?php
/* @var $this DueInformationController */
/* @var $model DueInformation */

$this->breadcrumbs=array(
	'Due Informations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DueInformation', 'url'=>array('index')),
	array('label'=>'Create DueInformation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('due-information-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Due Informations</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('MGridView', array(
	'id'=>'due-information-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'area_name',
		'occupation',
		'customer_name',
		'product',
		'price',
		/*
		'added_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
