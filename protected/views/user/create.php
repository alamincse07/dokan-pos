<?php
/* @var $this UserController */
/* @var $model User */
// FOR LANGUAGE
$L=$this::$L;
$this->breadcrumbs=array(
    $L->g('Users')=>array('index'),
    $L->g('Create'),
);



$this->menu=array(
	array('label'=>$L->g('List User'), 'url'=>array('index')),
	array('label'=>$L->g('Manage User'), 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>