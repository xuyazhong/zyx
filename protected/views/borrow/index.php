<?php
/* @var $this BorrowController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Borrows',
);

$this->menu=array(
	array('label'=>'Create Borrow', 'url'=>array('create')),
	array('label'=>'Manage Borrow', 'url'=>array('admin')),
);
?>

<h1>Borrows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
