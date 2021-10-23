<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */

$this->breadcrumbs=array(
	'Daily Sell Informations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DailySellInformation', 'url'=>array('index')),
	array('label'=>'Create DailySellInformation', 'url'=>array('create')),
);


$profit_visible = (isset(Yii::app()->session['user_type'] ) && Yii::app()->session['user_type'] ==1)?true:false;
?>

<h1>Manage Daily Sell Informations </h1>

<?php $this->widget('MGridView', array(
	'id'=>'daily-sell-information-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',

        array(
            'name'=>'article',
            'value'=>'$data->article',
            'visible'=>true,
            /*'header'=>false,
            'filter'=>false,*/
            'htmlOptions'=>array('style'=>'width:20%'),
        ),
        'category',

        'price',
        array(
            'name'=>'profit',
            'value'=>'$data->profit',
            'visible'=>$profit_visible,
            /*'header'=>false,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'display:none'),*/
        ),

        'date',
       // 'manager',
        'sells_man',
		//'size',
		//'color',
		/*
		'manager',
		'sells_man',
		'price',
		'profit',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
