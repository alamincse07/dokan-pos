<?php
/* @var $this UserGroupController */
/* @var $dataProvider CActiveDataProvider */
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
    $L->g('User Groups'),
);



$this->menu=array(
	array('label'=>$L->g('Create User Group'), 'url'=>array('create')),
	array('label'=>$L->g('Manage User Group'), 'url'=>array('admin')),
);
?>

<h1><?=$L->g('User Groups')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
