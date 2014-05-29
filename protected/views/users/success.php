<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'用户'=>array('index'),
	'注册',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>注册成功</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>