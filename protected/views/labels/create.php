<?php
/* @var $this LabelsController */
/* @var $model Labels */


$this->menu=array(

	array('label'=>'Manage Labels', 'url'=>array('admin')),
	array('label'=>'এখানে নেই? যোগ করো', 'url'=>array('tags/create')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>