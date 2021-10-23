<?php
/* @var $this AreaNamesController */
/* @var $model AreaNames */

$this->breadcrumbs=array(
	'Area Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AreaNames', 'url'=>array('index')),
	array('label'=>'Manage AreaNames', 'url'=>array('admin')),
);
?>

<h1>Create AreaNames</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>