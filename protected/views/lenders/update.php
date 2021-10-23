<?php
/* @var $this LendersController */
/* @var $model Lenders */

$this->breadcrumbs=array(
	'Lenders'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lenders', 'url'=>array('index')),
	array('label'=>'Create Lenders', 'url'=>array('create')),
	array('label'=>'View Lenders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lenders', 'url'=>array('admin')),
);
?>

<h1>Update Lenders <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>