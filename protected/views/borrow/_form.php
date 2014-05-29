<?php
/* @var $this BorrowController */
/* @var $model Borrow */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'borrow-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'book_id'); ?>
		<?php echo $form->textField($model,'book_id'); ?>
		<?php echo $form->error($model,'book_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'book_title'); ?>
		<?php echo $form->textField($model,'book_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'book_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'borrow_date'); ?>
		<?php echo $form->textField($model,'borrow_date',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'borrow_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'borrow_time'); ?>
		<?php echo $form->textField($model,'borrow_time',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'borrow_time'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'back_date'); ?>
        <?php echo $form->textField($model,'back_date',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'back_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'back_time'); ?>
        <?php echo $form->textField($model,'back_time',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'back_time'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->