<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
//FOR Language
$L=$this::$L;
$this->breadcrumbs=array(
    $L->g('Settings'),
    $L->g('User Groups')=>array('index'),
    $L->g('Create'),
);


$this->menu=array(
	array('label'=>$L->g('List User Group'), 'url'=>array('index')),
	array('label'=>$L->g('Manage User Group'), 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>