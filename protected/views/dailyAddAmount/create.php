<?php
/* @var $this DailyAddAmountController */
/* @var $model DailyAddAmount */

$this->breadcrumbs=array(
	'Daily Add Amounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DailyAddAmount', 'url'=>array('index')),
	array('label'=>'Manage DailyAddAmount', 'url'=>array('admin')),
);
?>

<h1>Create DailyAddAmount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>