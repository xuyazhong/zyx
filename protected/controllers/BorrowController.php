<?php

class BorrowController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','back','again'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Borrow;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Borrow']))
		{
			$model->attributes=$_POST['Borrow'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


    public function actionAgain()
    {
        $time=time();
        $back=$time+60*60*24*7;
        $borrowdate=date("Y-m-d",$time);
        $borrowtime=date("H:i:s",$time);
        $backdate=date("Y-m-d",$back);
        $backtime=date("H:i:s",$back);
        $sql='select userid from users where username=\''.$_GET['user'].'\'';
        $userid=Yii::app()->db->CreateCommand($sql)->queryScalar();
        $sql='select id from borrow where user_id=\''.$userid.'\' and book_id='.$_GET['book_id'];
        $id=Yii::app()->db->CreateCommand($sql)->queryScalar();
        //echo "[$borrowdate][$borrowtime][$backdate][$backtime]";
        //die();
        $bookid=$_GET['book_id'];
        $sql='update borrow set borrow_date=\''.$borrowdate.'\',borrow_time=\''.$borrowtime.'\',back_date=\''.$backdate.'\',back_time=\''.$backtime.'\' where book_id='.$bookid.' and user_id='.$userid;
        Yii::app()->db->CreateCommand($sql)->execute();
        $this->render('again',array(
            //$model->attributes=$_GET['book_id'];
            'model'=>$this->loadModel($id),
            'stat'=>'本书已续借',
        ));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Borrow']))
		{
			$model->attributes=$_POST['Borrow'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Borrow');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
       $sql='select userid from users where username=\''.Yii::app()->user->name.'\'';
       $userid=Yii::app()->db->CreateCommand($sql)->queryScalar();
		$model=new Borrow('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Borrow']))
			$model->attributes=$_GET['Borrow'];
       $model->user_id=$userid;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Borrow the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Borrow::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Borrow $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='borrow-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
