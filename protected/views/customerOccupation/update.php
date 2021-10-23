<?php
/* @var $this CustomerOccupationController */
/* @var $model CustomerOccupation */

$this->breadcrumbs=array(
	'Customer Occupations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerOccupation', 'url'=>array('index')),
	array('label'=>'Create CustomerOccupation', 'url'=>array('create')),
	array('label'=>'View CustomerOccupation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerOccupation', 'url'=>array('admin')),
);
?>

<h1>Update CustomerOccupation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>