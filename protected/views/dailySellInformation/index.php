<?php
/* @var $this DailySellInformationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Daily Sell Informations',
);

$this->menu=array(
	array('label'=>'Create DailySellInformation', 'url'=>array('create')),
	array('label'=>'Manage DailySellInformation', 'url'=>array('admin')),
);
?>

<h1>Daily Sell Informations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
