<?php
/* @var $this BorrowController */
/* @var $data Borrow */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_id')); ?>:</b>
	<?php echo CHtml::encode($data->book_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_title')); ?>:</b>
	<?php echo CHtml::encode($data->book_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('borrow_date')); ?>:</b>
	<?php echo CHtml::encode($data->borrow_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('borrow_time')); ?>:</b>
	<?php echo CHtml::encode($data->borrow_time); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('back_date')); ?>:</b>
    <?php echo CHtml::encode($data->back_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('back_time')); ?>:</b>
    <?php echo CHtml::encode($data->back_time); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>