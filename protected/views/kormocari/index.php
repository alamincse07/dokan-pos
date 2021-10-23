<?php
/* @var $this KormocariController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kormocaris',
);

$this->menu=array(
	array('label'=>'Create Kormocari', 'url'=>array('create')),
	array('label'=>'Manage Kormocari', 'url'=>array('admin')),
);
?>

<h1>Kormocaris</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
