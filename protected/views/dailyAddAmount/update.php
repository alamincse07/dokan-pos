<?php
/* @var $this DailyAddAmountController */
/* @var $model DailyAddAmount */

$this->breadcrumbs=array(
	'Daily Add Amounts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DailyAddAmount', 'url'=>array('index')),
	array('label'=>'Create DailyAddAmount', 'url'=>array('create')),
	array('label'=>'View DailyAddAmount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DailyAddAmount', 'url'=>array('admin')),
);
?>

<h1>Update DailyAddAmount <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>