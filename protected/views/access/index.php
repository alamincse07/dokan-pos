<?php
/* @var $this AccessController */
/* @var $dataProvider CActiveDataProvider */
//FOR LANGUAGE
$L = $this::$L;

$this->breadcrumbs=array(
	$L->g('Accesses'),
);



$this->menu=array(
	array('label'=>$L->g('Create Access'), 'url'=>array('create')),
	array('label'=>$L->g('Manage Access'), 'url'=>array('admin')),
);
?>

<h1>Accesses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
