<?php
/* @var $this RememberEventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Remember Events',
);

$this->menu=array(
	array('label'=>'Create RememberEvent', 'url'=>array('create')),
	array('label'=>'Manage RememberEvent', 'url'=>array('admin')),
);
?>

<h1>Remember Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
