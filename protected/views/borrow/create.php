<?php
/* @var $this BorrowController */
/* @var $model Borrow */

$this->breadcrumbs=array(
	'Borrows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Borrow', 'url'=>array('index')),
	array('label'=>'Manage Borrow', 'url'=>array('admin')),
);
?>

<h1>Create Borrow</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>