<?php
/* @var $this AccessController */
/* @var $model Access */
//$this->labels =GenericProperties::getCacheLabels();
//FOR LANGUAGE
$L=$this::$L;
$this->breadcrumbs=array(
    $L->g('Settings'),
	$L->g('Accesses')=>array('index'),
    $L->g('Manage'),
);



$this->menu=array(
	array('label'=>$L->g('List Access'), 'url'=>array('index')),
	array('label'=>$L->g('Create Access'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#access-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <h3><?php echo $L->g('Manage Access')?></h3>
    <h4 class="create-link"> <?=CHtml::link('<i>'.
            $L->g("New Access").'</i>',
            $this->createUrl('access/create'));?></h4>




<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('MGridView', array(
	'id'=>'access-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/MGridpager.css'),
    'summaryText' => 'Viewing <i>{start} to {end} of {count}</i> records',
    'itemsCssClass' => 'table table-striped table-bordered pointer',
    'htmlOptions' => array('class' => 'mgridview'),
    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl(Yii::app()->controller->id.'/update', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

    'columns'=>array(
		'id',
		array('name'=>'user_id','filter'=>CHtml::listData(User::model()->findAll(),'id','username'),'value'=>array($model,'getUserName')),
		array('name'=>'group_id','filter'=>CHtml::listData(UserGroup::model()->findAll(),'id','group'),'value'=>array($model,'getGroupName')),

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
