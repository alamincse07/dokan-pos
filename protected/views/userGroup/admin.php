<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
//$this->labels =GenericProperties::getCacheLabels();
/**
 * @var $L Language
 */
$L = $this::$L;
$this->breadcrumbs=array(
    $L->g('Settings'),
	$L->g('User Groups')=>array('index'),
    $L->g('Manage'),
);


$this->menu=array(
	array('label'=>$L->g('List UserGroup'), 'url'=>array('index')),
	array('label'=>$L->g('Create UserGroup'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="widget-header "><i class="icon-user"></i>

        <h3><?php echo $L->g('Manage User Group') ?></h3>
    <h5 class="create-link"> <?=CHtml::link('<i>'.
            $L->g("Create New UserGroup").'</i>',
            $this->createUrl('create'));?>
    </h5>

</div>





<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<!--<div class="clear"></div>

<div class="grid-loading">
    <img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/loading.gif" alt="Loading...">
</div>-->
<?php $this->widget('MGridView', array(
	'id'=>'user-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,


    'itemsCssClass' => 'table table-striped table-bordered pointer',
    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/update', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
    'htmlOptions' => array('class' => 'mgridview'),
	'columns'=>array(
		'id',
		'group',
		'create_date',
		'update_date',
        array('name'=>'active','filter'=>Enum::yesNo(),'value'=>array($model,'getActiveText')),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
		),
	),
)); ?>

<script>
    $('select').attr('class','form-control').css('width','100%');
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
