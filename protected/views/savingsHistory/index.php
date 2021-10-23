<?php
/* @var $this SavingsHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Savings Histories',
);

$this->menu=array(
	array('label'=>'Create SavingsHistory', 'url'=>array('create')),
	array('label'=>'Manage SavingsHistory', 'url'=>array('admin')),
);
?>

<h1>Savings Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
