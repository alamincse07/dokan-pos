<?php
/* @var $this CustomerTransactionController */
/* @var $model CustomerTransaction */

$this->breadcrumbs=array(
	'Customer Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CustomerTransaction', 'url'=>array('index')),
	array('label'=>'Create CustomerTransaction', 'url'=>array('create')),
	array('label'=>'View CustomerTransaction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CustomerTransaction', 'url'=>array('admin')),
);
?>

<h1>Update CustomerTransaction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>