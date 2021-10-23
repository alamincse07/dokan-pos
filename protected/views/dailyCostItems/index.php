<?php
/* @var $this DailyCostItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Daily Cost Items',
);

$this->menu=array(
	array('label'=>'Create DailyCostItems', 'url'=>array('create')),
	array('label'=>'Manage DailyCostItems', 'url'=>array('admin')),
);
?>

<h1>Daily Cost Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
