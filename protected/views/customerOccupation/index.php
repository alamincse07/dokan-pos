<?php
/* @var $this CustomerOccupationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customer Occupations',
);

$this->menu=array(
	array('label'=>'Create CustomerOccupation', 'url'=>array('create')),
	array('label'=>'Manage CustomerOccupation', 'url'=>array('admin')),
);
?>

<h1>Customer Occupations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
