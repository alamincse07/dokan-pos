<?php
/* @var $this CustomerTransactionController */
/* @var $model CustomerTransaction */

$this->breadcrumbs=array(
	'Customer Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CustomerTransaction', 'url'=>array('index')),
	array('label'=>'Manage CustomerTransaction', 'url'=>array('admin')),
);
?>

<h1>Create CustomerTransaction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>