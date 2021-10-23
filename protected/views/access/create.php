<?php
/* @var $this AccessController */
/* @var $model Access */
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
	$L->g('Accesses')=>array('index'),
    $L->g('Create'),
);



$this->menu=array(
	array('label'=>$L->g('List Access'), 'url'=>array('index')),
	array('label'=>$L->g('Manage Access'), 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>