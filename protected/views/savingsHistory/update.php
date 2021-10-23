<?php
/* @var $this SavingsHistoryController */
/* @var $model SavingsHistory */

$this->breadcrumbs=array(
	'Savings Histories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SavingsHistory', 'url'=>array('index')),
	array('label'=>'Create SavingsHistory', 'url'=>array('create')),
	array('label'=>'View SavingsHistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SavingsHistory', 'url'=>array('admin')),
);
?>

<h1>Update SavingsHistory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>