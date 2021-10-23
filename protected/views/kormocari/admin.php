<?php
/* @var $this KormocariController */
/* @var $model Kormocari */

$this->breadcrumbs=array(
	'Kormocaris'=>array('index'),
	'Manage',
);
$qr=" select cost_name from cost_items where  cost_type=2";
$qr_res= Yii::app()->db->createCommand($qr)->query();
//Generic::_setTrace($qr_res);
$dokan_stuff='<option value="">Select</option>';

while($row=$qr_res->read()){
    //Generic::_setTrace($row);
    $dokan_stuff.='<option value="'.$row['cost_name'].'">'.$row['cost_name'].'</option>';
    // $dokan_stuff[]= $row['cost_name'];
}

$this->menu=array(
	array('label'=>'List Kormocari', 'url'=>array('index')),
	array('label'=>'Create Kormocari', 'url'=>array('create')),
);
/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
 $('.date_picker').datepicker({ dateFormat: 'yy-mm-dd' });
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kormocari-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1>Manage Kormocaris</h1>

<div  class="single-page-header">

    <form action="" method="get">


        <div  class="claim_form">
           নাম
            <select  id="profit_article" name="k_name"  size="1">

                <?=$dokan_stuff?>
            </select>
            তারিখ শুরু
            <?=Generic::AddDatePicker('date_start')?>
            <!--<input type="text"  size="10" class="date_picker" name="date_start" value="<?/*=date('Y-m-d')*/?>">
-->
            তারিখ শেষ
            <?=Generic::AddDatePicker('date_end')?>
            <!--<input type="text" size="10" class="date_picker" name="date_end" value="<?/*=date('Y-m').'-30'*/?>">
          -->
            <input type="submit"  class="button" name="kormocari_info" value="দেখুন ">
        </div>
    </form>
</div>


<?php $this->widget('MGridView', array(
	'id'=>'kormocari-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'taken_date',
		//'leave',
		//'amount',

        array(
            'name'=>'leave',
            //'footer'=>(isset($_GET['date_start']))?$model->pageTotal($model->search()->getData(),'leave') :0 ,
            'footer'=>' ' . $model->getTotal($model->search(), 'leave'),

        ),

        array(
            'name'=>'amount',
            'footer'=>' ' . $model->getTotal($model->search(), 'amount'),

        ),
		'manager',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>



