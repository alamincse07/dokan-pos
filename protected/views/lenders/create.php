<?php
/* @var $this LendersController */
/* @var $model Lenders */

$this->breadcrumbs=array(
	'Lenders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lenders', 'url'=>array('index')),
	array('label'=>'Manage Lenders', 'url'=>array('admin')),
);
?>

<h1>Create Lenders</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>