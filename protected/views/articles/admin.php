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

		'total_pair',
		//'total_taka',

		'actual_price',
		'body_rate',
		'last_added_pair',
		//'last_added_taka',
        'added_date',
		array(
            'name'=>'orginal_article',
            'footer'=>$model->getTotal($model->search(), 'total_pair'),

        ),
		'increment',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
