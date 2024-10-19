<?php
/* @var $this LabelsController */
/* @var $model Labels */

$this->breadcrumbs=array(
	'Labels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(

	array('label'=>'Create Labels', 'url'=>array('create')),

	array('label'=>'Manage Labels', 'url'=>array('admin')),
);
?>

<h1>Update Labels <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>