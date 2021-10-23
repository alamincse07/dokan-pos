<?php
/* @var $this KormocariController */
/* @var $model Kormocari */

$this->breadcrumbs=array(
	'Kormocaris'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kormocari', 'url'=>array('index')),
	array('label'=>'Manage Kormocari', 'url'=>array('admin')),
);
?>

<h1>Create Kormocari</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>