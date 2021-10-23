<?php
/* @var $this AreaNamesController */
/* @var $model AreaNames */

$this->breadcrumbs=array(
	'Area Names'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AreaNames', 'url'=>array('index')),
	array('label'=>'Create AreaNames', 'url'=>array('create')),
	array('label'=>'View AreaNames', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AreaNames', 'url'=>array('admin')),
);
?>

<h1>Update AreaNames <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>