<?php
/* @var $this MemberController */
/* @var $data Member */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_name')); ?>:</b>
	<?php echo CHtml::encode($data->member_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_password')); ?>:</b>
	<?php echo CHtml::encode($data->member_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_type')); ?>:</b>
	<?php echo CHtml::encode($data->member_type); ?>
	<br />


</div>