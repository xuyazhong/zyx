<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'用户登陆',
);
?>

<h1>用户登陆</h1>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">带 <span class="required">*</span> 为必填.</p>

	<div class="row">
		<?php /*echo $form->labelEx($model,'username'); */?><b>用户名</b><br>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'password'); */?><b>密码</b><br>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>

	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('登陆'); ?>  <a href="<?php echo $this->createUrl('users/create') ; ?>" >注册</a>
	</div>


<?php $this->endWidget(); ?>
</div><!-- form -->
