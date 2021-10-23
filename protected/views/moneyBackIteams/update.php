<?php
/* @var $this MoneyBackIteamsController */
/* @var $model MoneyBackIteams */

$this->breadcrumbs=array(
	'Money Back Iteams'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MoneyBackIteams', 'url'=>array('index')),
	array('label'=>'Create MoneyBackIteams', 'url'=>array('create')),
	array('label'=>'View MoneyBackIteams', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MoneyBackIteams', 'url'=>array('admin')),
);
?>

<h1>Update MoneyBackIteams <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>