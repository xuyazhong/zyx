<?php
/* @var $this BorrowController */
/* @var $model Borrow */

$this->breadcrumbs=array(
	'Borrows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Borrow', 'url'=>array('index')),
	array('label'=>'Create Borrow', 'url'=>array('create')),
	array('label'=>'View Borrow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Borrow', 'url'=>array('admin')),
);
?>

<h1>Update Borrow <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>