<?php
/* @var $this DailyAddAmountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Daily Add Amounts',
);

$this->menu=array(
	array('label'=>'Create DailyAddAmount', 'url'=>array('create')),
	array('label'=>'Manage DailyAddAmount', 'url'=>array('admin')),
);
?>

<h1>Daily Add Amounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
