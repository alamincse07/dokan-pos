<?php
/* @var $this SavingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Savings',
);

$this->menu=array(
	array('label'=>'Create Savings', 'url'=>array('create')),
	array('label'=>'Manage Savings', 'url'=>array('admin')),
);
?>

<h1>Savings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
