<?php
/* @var $this SavingsController */
/* @var $model Savings */

$this->breadcrumbs=array(
	'Savings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Savings', 'url'=>array('index')),
	array('label'=>'Manage Savings', 'url'=>array('admin')),
);
?>

<h1>Create Savings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>