<?php
/* @var $this GroupPermissionController */
/* @var $dataProvider CActiveDataProvider */

/**
 * @var $L Language
 */
$L = $this::$L;

$this->breadcrumbs=array(
    $L->g('Group Permissions'),
);



$this->menu=array(
	array('label'=>$L->g('Create Group Permission'), 'url'=>array('create')),
	array('label'=>$L->g('Manage Group Permission'), 'url'=>array('admin')),
);
?>

<h1><?=$L->g('Group Permissions')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
