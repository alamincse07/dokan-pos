<?php
/* @var $this MoneyBackIteamsController */
/* @var $model MoneyBackIteams */

$this->breadcrumbs=array(
	'Money Back Iteams'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MoneyBackIteams', 'url'=>array('index')),
	array('label'=>'Manage MoneyBackIteams', 'url'=>array('admin')),
);
?>

<h1>Create MoneyBackIteams</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>