<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */

$this->breadcrumbs=array(
	'Last Added Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LastAddedItems', 'url'=>array('index')),
	array('label'=>'Create LastAddedItems', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('last-added-items-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Last Added Items</h1>
<div  class="single-page-header">

    <form action="" method="get">


        <div  class="claim_form">
           নাম
            <input   id="profit_article" name="article_name"  size="30">

            </select>
            তারিখ শুরু
            <?=Generic::AddDatePicker('date_start')?>
            <!--<input type="text"  size="10" class="date_picker" name="date_start" value="<?/*=date('Y-m-d')*/?>">
-->
            তারিখ শেষ
            <?=Generic::AddDatePicker('date_end')?>
            <!--<input type="text" size="10" class="date_picker" name="date_end" value="<?/*=date('Y-m').'-30'*/?>">
          -->
            <input type="submit"  class="button" name="article_info" value="দেখুন ">
        </div>
    </form>
</div>

<?php $this->widget('MGridView', array(
	'id'=>'last-added-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'article',
        array(
            'name'=>'article',
            'value'=>'$data->article',
            'visible'=>true,
            /*'header'=>false,
            'filter'=>false,*/
            'htmlOptions'=>array('style'=>'width:20%'),
        ),
		'category',
		'added_date',
		//'total_pair',
		array(
            'name'=>'total_pair',
            'footer'=>(isset($_GET['date_start'],$_GET['article_name'])  && !empty($_GET['article_name']))?$model->getTotal($model->search(),'total_pair') :'' ,
           // 'footer'=>' ' . $model->getTotal($model->search(), 'leave'),

        ),
		
		'body_rate',
		'actual_price',
		array(
            'name'=>'total_taka',
            'footer'=>(isset($_GET['date_start'],$_GET['article_name'])  && !empty($_GET['article_name'] ))?$model->getTotal($model->search(),'total_taka') :'' ,
           // 'footer'=>' ' . $model->getTotal($model->search(), 'leave'),

        ),

		/*
		'actual_price',
		'body_rate',
		'last_added_pair',
		'last_added_taka',
		'orginal_article',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
