<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */

$this->breadcrumbs=array(
	'Last Added Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LastAddedItems', 'url'=>array('index')),
	array('label'=>'Create LastAddedItems', 'url'=>array('create')),
	array('label'=>'View LastAddedItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LastAddedItems', 'url'=>array('admin')),
);
?>

<h1>Update LastAddedItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>