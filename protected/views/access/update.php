<?php
/* @var $this AccessController */
/* @var $model Access */
//FOR LANGUAGE
$L = $this::$L;

$this->breadcrumbs=array(
	$L->g('Accesses')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
    $L->g('Update'),
);


$this->menu=array(
	array('label'=>$L->g('List Access'), 'url'=>array('index')),
	array('label'=>$L->g('Create Access'), 'url'=>array('create')),
	array('label'=>$L->g('View Access'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>$L->g('Manage Access'), 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>