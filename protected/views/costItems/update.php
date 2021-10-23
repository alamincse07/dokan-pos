<?php
/* @var $this CostItemsController */
/* @var $model CostItems */

$this->breadcrumbs=array(
	'Cost Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CostItems', 'url'=>array('index')),
	array('label'=>'Create CostItems', 'url'=>array('create')),
	array('label'=>'View CostItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CostItems', 'url'=>array('admin')),
);
?>

<h1>Update CostItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>