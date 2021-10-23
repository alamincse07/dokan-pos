<?php
/* @var $this KormocariController */
/* @var $model Kormocari */

$this->breadcrumbs=array(
	'Kormocaris'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kormocari', 'url'=>array('index')),
	array('label'=>'Create Kormocari', 'url'=>array('create')),
	array('label'=>'View Kormocari', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kormocari', 'url'=>array('admin')),
);
?>

<h1>Update Kormocari <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>