<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);



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

		array(
            'name'=>'total_pair',
            'footer'=>$model->getTotal($model->search(), 'total_pair'),

        ),
		//'total_taka',

		'actual_price',
		'body_rate',
		'last_added_pair',
		'tags',
        'added_date',
		
		'increment',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
