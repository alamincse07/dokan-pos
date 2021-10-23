<?php
/* @var $this LendersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lenders',
);

$this->menu=array(
	array('label'=>'Create Lenders', 'url'=>array('create')),
	array('label'=>'Manage Lenders', 'url'=>array('admin')),
);
?>

<h1>Lenders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
