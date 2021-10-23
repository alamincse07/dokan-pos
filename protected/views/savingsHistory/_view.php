<?php
/* @var $this SavingsHistoryController */
/* @var $data SavingsHistory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('savings_id')); ?>:</b>
	<?php echo CHtml::encode($data->savings_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pull_date')); ?>:</b>
	<?php echo CHtml::encode($data->pull_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('term')); ?>:</b>
	<?php echo CHtml::encode($data->term); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>