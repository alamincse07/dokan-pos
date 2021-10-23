<?php
/* @var $this CostItemsController */
/* @var $model CostItems */

$this->breadcrumbs=array(
	'Cost Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CostItems', 'url'=>array('index')),
	array('label'=>'Manage CostItems', 'url'=>array('admin')),
);
?>

<h1>Create CostItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>