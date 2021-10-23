<?php
/* @var $this CustomerTransactionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customer Transactions',
);

$this->menu=array(
	array('label'=>'Create CustomerTransaction', 'url'=>array('create')),
	array('label'=>'Manage CustomerTransaction', 'url'=>array('admin')),
);
?>

<h1>Customer Transactions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
