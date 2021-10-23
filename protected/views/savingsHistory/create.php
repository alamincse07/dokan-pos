<?php
/* @var $this SavingsHistoryController */
/* @var $model SavingsHistory */

$this->breadcrumbs=array(
	'Savings Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SavingsHistory', 'url'=>array('index')),
	array('label'=>'Manage SavingsHistory', 'url'=>array('admin')),
);
?>

<h1>Create SavingsHistory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>