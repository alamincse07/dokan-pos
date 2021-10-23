<?php
/* @var $this DueInformationController */
/* @var $model DueInformation */

$this->breadcrumbs=array(
	'Due Informations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DueInformation', 'url'=>array('index')),
	array('label'=>'Create DueInformation', 'url'=>array('create')),
	array('label'=>'View DueInformation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DueInformation', 'url'=>array('admin')),
);
?>

<h1>Update DueInformation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>