<?php
/* @var $this RememberEventController */
/* @var $model RememberEvent */

$this->breadcrumbs=array(
	'Remember Events'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RememberEvent', 'url'=>array('index')),
	array('label'=>'Create RememberEvent', 'url'=>array('create')),
	array('label'=>'View RememberEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RememberEvent', 'url'=>array('admin')),
);
?>

<h1>Update RememberEvent <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>