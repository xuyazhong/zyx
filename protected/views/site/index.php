<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>欢迎登陆<i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<!--<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
-->