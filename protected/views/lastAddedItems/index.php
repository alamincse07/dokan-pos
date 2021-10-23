<?php
/* @var $this LastAddedItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Last Added Items',
);

$this->menu=array(
	array('label'=>'Create LastAddedItems', 'url'=>array('create')),
	array('label'=>'Manage LastAddedItems', 'url'=>array('admin')),
);
?>

<h1>Last Added Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
