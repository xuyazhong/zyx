<?php
/* @var $this BorrowController */
/* @var $model Borrow */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<!--	<div class="row">
		<?php /*echo $form->label($model,'id'); */?>
		<?php /*echo $form->textField($model,'id'); */?>
	</div>
-->
<!--	<div class="row">
		<?php /*echo $form->label($model,'book_id'); */?>
		<?php /*echo $form->textField($model,'book_id'); */?>
	</div>
-->
<!--	<div class="row">
		<?php /*echo $form->label($model,'book_title'); */?>
		<?php /*echo $form->textField($model,'book_title',array('size'=>10,'maxlength'=>12)); */?>
	</div>-->
    <b>书名</b>
    <?php echo $form->textField($model,'book_title',array('size'=>10,'maxlength'=>12)); ?>
    <br>
    <b>借书日期</b>
    <?php
    //$f = Yii::app()->request->getParam('_from_date', date('Y-m-d'));
    //$ft = Yii::app()->request->getParam('_from_time', '00:00');

    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    $this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'borrow_date', //attribute name
        'mode'=>'date', //use "time","date" or "datetime" (default)
        'options'=>array(
            'dateFormat'=>'yy-mm-dd',
            'maxDate'=>'0D',
        ),// jquery plugin options
    ));
    ?>
<!--	<div class="row">
		<?php /*echo $form->label($model,'borrow_date'); */?>
		<?php /*echo $form->textField($model,'borrow_date',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'borrow_time'); */?>
		<?php /*echo $form->textField($model,'borrow_time',array('size'=>60,'maxlength'=>255)); */?>
	</div>

    <div class="row">
		<?php echo $form->label($model,'back_date'); ?>
		<?php echo $form->textField($model,'back_date',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'back_time'); ?>
		<?php echo $form->textField($model,'back_time',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'user_id'); */?>
		<?php /*echo $form->textField($model,'user_id'); */?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->