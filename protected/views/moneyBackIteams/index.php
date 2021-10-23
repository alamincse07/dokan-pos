<?php
/* @var $this MoneyBackIteamsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Money Back Iteams',
);

$this->menu=array(
	array('label'=>'Create MoneyBackIteams', 'url'=>array('create')),
	array('label'=>'Manage MoneyBackIteams', 'url'=>array('admin')),
);
?>

<h1>Money Back Iteams</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
