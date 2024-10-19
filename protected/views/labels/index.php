<?php
/* @var $this LabelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Labels',
);

$this->menu=array(
	array('label'=>'Create Labels', 'url'=>array('create')),
	array('label'=>'Manage Labels', 'url'=>array('admin')),
);
?>

<h1>Labels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
