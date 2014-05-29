<?php
/* @var $this BorrowController */
/* @var $model Borrow */

$this->breadcrumbs=array(
	'借书'=>array('index'),
	'我借的书',
);

$this->menu=array(
	array('label'=>'List Borrow', 'url'=>array('index')),
	array('label'=>'Create Borrow', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#borrow-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>我借的书</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'borrow-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'id',
        //'book_id',
        'book_title',
        'borrow_date',
        //'borrow_time',
        'back_date',
        //'back_time',
		//'user_id',
		array(
			'class'=>'CButtonColumn',
           'template'=>'{again} {back}',
            'buttons'=>array(
                'again'=>array(
                    'label'=>'续借',
                    'url'=>'Yii::app()->controller->createUrl("again",array("book_id"=>$data->book_id,"user"=>Yii::app()->user->name))',
                ),
                'back'=>array(
                    'label'=>'还书',
                    'url'=>'Yii::app()->controller->createUrl("books/back",array("book_id"=>$data->book_id,"user"=>Yii::app()->user->name))',
                ),
            ),
		),
	),
)); ?>
