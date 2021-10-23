<?php
/* @var $this CustomerOccupationController */
/* @var $model CustomerOccupation */

$this->breadcrumbs=array(
	'Customer Occupations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerOccupation', 'url'=>array('index')),
	array('label'=>'Manage CustomerOccupation', 'url'=>array('admin')),
);
?>

<h1>Create CustomerOccupation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>