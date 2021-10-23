<?php
/* @var $this LastAddedItemsController */
/* @var $data LastAddedItems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article')); ?>:</b>
	<?php echo CHtml::encode($data->article); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added_date')); ?>:</b>
	<?php echo CHtml::encode($data->added_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_pair')); ?>:</b>
	<?php echo CHtml::encode($data->total_pair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_taka')); ?>:</b>
	<?php echo CHtml::encode($data->total_taka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actual_price')); ?>:</b>
	<?php echo CHtml::encode($data->actual_price); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('body_rate')); ?>:</b>
	<?php echo CHtml::encode($data->body_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_added_pair')); ?>:</b>
	<?php echo CHtml::encode($data->last_added_pair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_added_taka')); ?>:</b>
	<?php echo CHtml::encode($data->last_added_taka); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orginal_article')); ?>:</b>
	<?php echo CHtml::encode($data->orginal_article); ?>
	<br />

	*/ ?>

</div>