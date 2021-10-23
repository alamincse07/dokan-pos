<?php
/* @var $this LastAddedItemsController */
/* @var $model LastAddedItems */

$this->breadcrumbs=array(
	'Last Added Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LastAddedItems', 'url'=>array('index')),
	array('label'=>'Manage LastAddedItems', 'url'=>array('admin')),
);
?>

<h1>Create LastAddedItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>