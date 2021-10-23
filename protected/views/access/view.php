<?php
/* @var $this AccessController */
/* @var $model Access */
//$this->labels =GenericProperties::getCacheLabels();
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
	$L->g('Accesses')=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>$L->g('List Access'), 'url'=>array('index')),
	array('label'=>$L->g('Create Access'), 'url'=>array('create')),
	array('label'=>$L->g('Update Access'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>$L->g('Delete Access'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>$L->g('Are you sure you want to delete this item?'))),
	array('label'=>$L->g('Manage Access'), 'url'=>array('admin')),
);
?>

<div class="mws-panel grid_7">
    <h2><?php echo $L->g('View Access')?> #<?php echo $model->id; ?></h2>
    <div class="mws-panel-header"></div>
    <div class="mws-panel-body" style="height: auto">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'user.username',
                'group.group',
            ),
        )); ?>
        <div class="clear"></div>
    </div>

    <div style="background-color: #606060; text-align: center;">
        <?php echo CHtml::link('<button class="btn btn-primary">Edit</button>',array('access/update/'.$model->id)); ?>
    </div>
</div>