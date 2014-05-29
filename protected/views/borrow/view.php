<?php
/* @var $this BorrowController */
/* @var $model Borrow */

$this->breadcrumbs=array(
	'Borrows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Borrow', 'url'=>array('index')),
	array('label'=>'Create Borrow', 'url'=>array('create')),
	array('label'=>'Update Borrow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Borrow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Borrow', 'url'=>array('admin')),
);
?>

<h1>View Borrow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'id',
        'book_id',
        'book_title',
        'borrow_date',
        'borrow_time',
        'back_date',
        'back_time',
        'user_id',
	),
)); ?>
