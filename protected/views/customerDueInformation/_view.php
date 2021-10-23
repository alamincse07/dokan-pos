<?php
/* @var $this CustomerDueInformationController */
/* @var $data CustomerDueInformation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_name')); ?>:</b>
	<?php echo CHtml::encode($data->area_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('occupation')); ?>:</b>
	<?php echo CHtml::encode($data->occupation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('articles')); ?>:</b>
	<?php echo CHtml::encode($data->articles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manager')); ?>:</b>
	<?php echo CHtml::encode($data->manager); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	*/ ?>

</div>