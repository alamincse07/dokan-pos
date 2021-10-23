<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */

/**
 * @var $L Language
 */
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('Group Permissions')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
    $L->g('Update'),
);

$this->menu=array(
	array('label'=>$L->g('List Group Permission'), 'url'=>array('index')),
	array('label'=>$L->g('Create Group Permission'), 'url'=>array('create')),
	array('label'=>$L->g('View Group Permission'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>$L->g('Manage Group Permission'), 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>