<?php
/* @var $this CustomerDueInformationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Customer Due Informations',
);

$this->menu=array(
	array('label'=>'Create CustomerDueInformation', 'url'=>array('create')),
	array('label'=>'Manage CustomerDueInformation', 'url'=>array('admin')),
);
?>

<h1>Customer Due Informations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
