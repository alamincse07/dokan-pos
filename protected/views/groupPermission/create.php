<?php
/* @var $this GroupPermissionController */
/* @var $model GroupPermission */

/**
 * @var $L Language
 */
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('Settings'),
    $L->g('Group Permissions')=>array('index'),
    $L->g('Create'),
);



$this->menu=array(
	array('label'=>$L->g('List Group Permission'), 'url'=>array('index')),
	array('label'=>$L->g('Manage Group Permission'), 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>