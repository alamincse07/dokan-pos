<?php
/* @var $this UserGroupController */
/* @var $model UserGroup */
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
    $L->g('User Groups')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
    $L->g('Update'),
);



$this->menu=array(
	array('label'=>$L->g('List User Group'), 'url'=>array('index')),
	array('label'=>$L->g('Create User Group'), 'url'=>array('create')),
	array('label'=>$L->g('View User Group'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>$L->g('Manage User Group'), 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>