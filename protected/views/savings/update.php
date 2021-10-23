<?php
/* @var $this SavingsController */
/* @var $model Savings */

$this->breadcrumbs=array(
	'Savings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Savings', 'url'=>array('index')),
	array('label'=>'Create Savings', 'url'=>array('create')),
	array('label'=>'View Savings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Savings', 'url'=>array('admin')),
);
?>

<h1>Update Savings <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>