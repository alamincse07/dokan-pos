<?php
/* @var $this CustomerDueInformationController */
/* @var $model CustomerDueInformation */

$this->breadcrumbs=array(
	'Customer Due Informations'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerDueInformation', 'url'=>array('index')),
	array('label'=>'Create CustomerDueInformation', 'url'=>array('create')),
	array('label'=>'View CustomerDueInformation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerDueInformation', 'url'=>array('admin')),
);
?>

<h1>Update CustomerDueInformation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>