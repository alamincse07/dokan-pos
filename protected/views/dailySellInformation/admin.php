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

<?php 


if(@Yii::app()->session['user_type']==1){
    $template='{view}{update}{delete}{print}';
}else{
    $template ='{print}';
}
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'daily-sell-information-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
        array(
            'name'=>'id',
            'value'=>'$data->id',
            'visible'=>$profit_visible,
            /*'header'=>false,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'display:none'),*/
        ),

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
        array(
            'name'=>'manager',
            'footer'=>(!empty($model->manager) && !empty($model->date))? $model->getTotal($model->search(), 'price'): '',

        ),
       
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
            'template' =>$template,
            'buttons' => array
            (
                'print' =>array
                (
                    'label' => 'Print Memo',
                    'ImageUrl' => yii::app ( )->request->baseurl. ' /images/edit.png ',
                    'url'=>'Yii::app()->createUrl("dailySellInformation/$data->id", array("print"=>$data->id))',
                ),
		),
	),
    )
)); ?>
