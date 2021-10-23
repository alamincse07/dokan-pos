<?php
/* @var $this CostItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cost Items',
);

$this->menu=array(
	array('label'=>'Create CostItems', 'url'=>array('create')),
	array('label'=>'Manage CostItems', 'url'=>array('admin')),
);
?>

<h1>Cost Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
