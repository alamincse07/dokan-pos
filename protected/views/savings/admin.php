<?php
/* @var $this SavingsController */
/* @var $model Savings */

$this->breadcrumbs=array(
	'Savings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Savings', 'url'=>array('index')),
	array('label'=>'Create Savings', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#savings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Savings</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'savings-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'account_number',
        'registration_no',
		'owner',
		'amount',
		'interval',
		'rate',

		'opend_date',
		//'last_taken',
		//'next_date',
		'period',
        array(
            'name'=>'next_date',
            'header'=>'Next Date',
            //'value'=>SavingsHistory::GetNextDate($data->id),
            'value'=>'isset($data->id)?SavingsHistory::GetNextDate($data->id):""'

        ),

		array(
			//'class'=>'CButtonColumn',
            'class'=>'CButtonColumn',
            'template'=>'{view} {update}',

        ),
	),
)); ?>
<style>
    .grid-view table.items th, .grid-view table.items td {
        border: 1px solid white;
        font-size: 1.2em;
        padding: 0.50em;
    }
</style>