<?php
/* @var $this CostItemsController */
/* @var $data CostItems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_name')); ?>:</b>
	<?php echo CHtml::encode($data->cost_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_type')); ?>:</b>
	<?php echo CHtml::encode($data->cost_type); ?>
	<br />


</div>