<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>
-->
	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		用户名<?php /*echo $form->labelEx($model,'username'); */?>
		<?php echo $form->textField($model,'username',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		密码<?php /*echo $form->labelEx($model,'password'); */?>
        <?php echo $form->passwordField($model,'password',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'password'); ?>

    </div>

<!--	<div class="row">
		<?php /*echo $form->labelEx($model,'role'); */?>
		<?php /*echo $form->textField($model,'role',array('size'=>9,'maxlength'=>9)); */?>
		<?php /*echo $form->error($model,'role'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'level'); */?>
		<?php /*echo $form->textField($model,'level'); */?>
		<?php /*echo $form->error($model,'level'); */?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '注册' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->