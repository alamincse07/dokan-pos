<?php
/* @var $this UserController */
/* @var $model User */
//$this->labels =GenericProperties::getCacheLabels();
//FOR LANGUAGE
$L=$this::$L;
$this->breadcrumbs=array(
    $L->g('Users')=>array('index'),
    $L->g('Manage'),
);


$this->menu=array(
	array('label'=>$L->g('List User'), 'url'=>array('index')),
	array('label'=>$L->g('Create User'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="widget-header "><i class="icon-user"></i>

        <h3><?php echo $L->g('Manage User') ?></h3>

</div>
<h4 class="create-link"> <?=CHtml::link('<i>'.
        $L->g("New User").'</i>',
        $this->createUrl('user/create'));?></h4>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="clear"></div>
<!--<div class="grid-loading">
    <img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/loading.gif" alt="Loading...">
</div>-->
<?php $this->widget('MGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    //'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/MGridpager.css'),
    'summaryText' => 'Viewing <i>{start} to {end} of {count}</i> records',
    'itemsCssClass' => 'table table-striped table-bordered pointer',
    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/update', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
    'htmlOptions' => array('class' => 'mgridview'),
	'columns'=>array(
		//'id',
		'username',
		/*'password',*/
		//'full_name',
        array(
            'name'=>'full_name',
            'header'=>$L->g('Full Name'),
            'value'=>'$data->first_name." ". $data->last_name'
            //'value'=>'Yii::app()->format->date(strtotime($data->date))'
        ),
		'email',
		//'create_date',
		'update_date',
		//array('name'=>'active','filter'=>Enum::yesNo(),'value'=>array($model,'getActiveText')),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
	),
));


?>

<script>

    $(document).ready(
        function()
        {

            $(".grid-loading img").bind("ajaxStart.dataGrid", function() {

                $(this).show();
            });

            $(".grid-loading img").bind("ajaxStop.dataGrid", function() {

                $(this).hide();
            });
        }
    );

</script>