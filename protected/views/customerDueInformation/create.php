<?php
/* @var $this CustomerDueInformationController */
/* @var $model CustomerDueInformation */

$this->breadcrumbs=array(
	'Customer Due Informations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerDueInformation', 'url'=>array('index')),
	array('label'=>'Manage CustomerDueInformation', 'url'=>array('admin')),
);
?>

<h1>Create CustomerDueInformation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>