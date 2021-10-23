<?php
/* @var $this AreaNamesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Area Names',
);

$this->menu=array(
	array('label'=>'Create AreaNames', 'url'=>array('create')),
	array('label'=>'Manage AreaNames', 'url'=>array('admin')),
);
?>

<h1>Area Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
