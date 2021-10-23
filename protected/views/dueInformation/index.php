<?php
/* @var $this DueInformationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Due Informations',
);

$this->menu=array(
	array('label'=>'Create DueInformation', 'url'=>array('create')),
	array('label'=>'Manage DueInformation', 'url'=>array('admin')),
);
?>

<h1>Due Informations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
