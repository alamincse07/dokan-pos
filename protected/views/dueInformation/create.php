<?php
/* @var $this DueInformationController */
/* @var $model DueInformation */

$this->breadcrumbs=array(
	'Due Informations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DueInformation', 'url'=>array('index')),
	array('label'=>'Manage DueInformation', 'url'=>array('admin')),
);
?>

<h1>Create DueInformation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>