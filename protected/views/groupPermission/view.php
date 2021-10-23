<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */
//$this->labels =GenericProperties::getCacheLabels();

/**
 * @var $L Language
 */
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('Group Permissions')=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>$L->g('List Group Permission'), 'url'=>array('index')),
	array('label'=>$L->g('Create Group Permission'), 'url'=>array('create')),
	array('label'=>$L->g('Update Group Permission'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>$L->g('Delete Group Permission'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>$L-g('Are you sure you want to delete this item?'))),
	array('label'=>$L->g('Manage Group Permission'), 'url'=>array('admin')),
);
?>
<div class="mws-panel grid_7">
<h2><?php echo $L->g('View Group Permission') ?> #<?php echo $model->id; ?></h2>
    <div class="mws-panel-header"></div>
    <div class="mws-panel-body" style="height: auto">
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                    'id',
                    'controller',
                    'action',
                    'group.group',
                    'create_date',
                    'update_date',
                ),
            )); ?>
        <div class="clear"></div>
    </div>

    <div style="background-color: #606060; text-align: center;">
        <?php echo CHtml::link('<button class="btn btn-primary">Edit</button>',array('groupPermission/update/'.$model->id)); ?>
    </div>
</div>