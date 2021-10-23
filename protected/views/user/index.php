<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
    $L->g('Users'),
);



$this->menu=array(
	array('label'=>$L->g('Create User'), 'url'=>array('create')),
	array('label'=>$L->g('Manage User'), 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
