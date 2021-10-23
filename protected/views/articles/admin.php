<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Articles', 'url'=>array('index')),
	array('label'=>'Create Articles', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});


$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('articles-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


?>


<h1>Manage Articles</h1>


<?php $this->widget('MGridView', array(
	'id'=>'articles-grid',
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

		'total_pair',
		'total_taka',

		'actual_price',
		'body_rate',
		'last_added_pair',
		'last_added_taka',
        'added_date',
		//'orginal_article',
		'increment',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
