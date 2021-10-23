<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
//$this->labels =GenericProperties::getCacheLabels();
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('User Groups')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>$L->g('List User Group'), 'url'=>array('index')),
	array('label'=>$L->g('Create User Group'), 'url'=>array('create')),
	array('label'=>$L->g('Update User Group'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>$L->g('Delete User Group'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>$L->g('Manage User Group'), 'url'=>array('admin')),
);
?>
<div class="mws-panel grid_7">
<h2>View <?php echo $L->g('View User Group') ?> #<?php echo $model->id; ?></h2>
    <div class="mws-panel-header"></div>
    <div class="mws-panel-body" style="height: auto">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'group',
                'create_date',
                'update_date',
                array('name'=>'action', 'value'=>$model->getActiveText($model)),
            ),
        )); ?>
        <div class="clear"></div>
    </div>

    <div style="background-color: #606060; text-align: center;">
        <?php echo CHtml::link('<button class="btn btn-primary">Edit</button>',array('userGroup/update/'.$model->id)); ?>
    </div>
</div>