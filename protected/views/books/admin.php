<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'借还图书'=>array('index'),
	'所有图书',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#books-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>图书管理</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'books-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'book_id',
		'title',
		//'author_or_editor',
		//'isbn',
		//'publisher',
		//'copyright_year',
		
		//'categories',
        array(
            'name'=>'categories',
            //'value'=>'$data->categories->category_name',
            'value'=>'$data->getcategory($data->categories)',
        ),
		//'audience',
		//'media',
		//'thumbnail_url',
		//'info_url',
		//'reference_url',
		//'reference_no',
		//'notes',
		//'status',
		//'borrower_id',
		//'due_date',
		//'date_created',
		//'date_modified',
		//'created_by',
		//'modified_by',
		'price',
		'total',
		//'borrowtime',
        //$model->getptime('borrowtime'),
		'leave_number',
		array(
			//'class'=>'CButtonColumn',
           'class'=>'CButtonColumn',
           'template'=>'{borrow} {back}',
            'buttons'=>array(
                'borrow'=>array(
                    'label'=>'借书',
                    'url'=>'Yii::app()->controller->createUrl("borrow",array("book_id"=>$data->book_id))',
                ),
                'back'=>array(
                    'label'=>'还书',
                    'url'=>'Yii::app()->controller->createUrl("back",array("book_id"=>$data->book_id,"user"=>Yii::app()->user->name))',
                ),
            ),
		),
	),
)); ?>
