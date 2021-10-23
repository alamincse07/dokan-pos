<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */
//$this->labels =GenericProperties::getCacheLabels();

/**
 * @var $L Language
 */
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('Settings'),
    $L->g('Group Permissions')=>array('index'),
    $L->g('Manage'),
);

$this->menu=array(
	array('label'=>$L->g('List Group Permission'), 'url'=>array('index')),
	array('label'=>$L->g('Create Group Permission'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#group-permission-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="widget-header "><i class="icon-user"></i>


        <h3><?php echo $L->g('Manage Group Permission') ?></h3>
      <h5 class="create-link"> <?=CHtml::link('<i>'.
            $L->g("Create New GroupPermission").'</i>',
            $this->createUrl('create'));?></h5>


</div>




<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?><!--
<div class="clear"></div>-->
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
	'id'=>'group-permission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    //'pager' => array('class' => 'paging_full_numbers', 'header' => ''),
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/MGridpager.css'),
    'summaryText' => 'Viewing <i>{start} to {end} of {count}</i> records',
    'itemsCssClass' => 'table table-striped table-bordered pointer',
    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/update', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
    'htmlOptions' => array('class' => 'mgridview'),
	'columns'=>array(
		'id',
		'controller',
		'action',
		array('name'=>'group_id',
            #'filter'=>CHtml::dropDownList('GroupPermission[group_id]','group_id',UserGroup::model()->getUserGroupComboService()),
            'filter'=>CHtml::listData(UserGroup::model()->findAll(),'id','group'),
            'value'=>array($model,'getGroupName')),
		'create_date',
		//'update_date',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
        ),
	),
)); ?>

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
