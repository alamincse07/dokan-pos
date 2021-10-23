<?php
/* @var $this RememberEventController */
/* @var $model RememberEvent */

$this->breadcrumbs=array(
	'Remember Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RememberEvent', 'url'=>array('index')),
	array('label'=>'Manage RememberEvent', 'url'=>array('admin')),
);
?>

<h1>Create RememberEvent</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>