<?php

class BooksController extends Controller
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
				'actions'=>array('index','view','borrow','back'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		$model=new Books;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Books']))
		{
			$model->attributes=$_POST['Books'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->book_id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Books']))
		{
			$model->attributes=$_POST['Books'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->book_id));
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
		$dataProvider=new CActiveDataProvider('Books');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    public function actionBorrow()
    {
        $user=Yii::app()->user->name;
        $sql='select leave_number from books where book_id=\''.$_GET['book_id'].'\'';
        $leave_number=Yii::app()->db->CreateCommand($sql)->queryScalar();
        if($leave_number>=1)
        {
        $sql='select userid from users where username=\''.$user.'\'';
        $userid=Yii::app()->db->CreateCommand($sql)->queryScalar();
        $sql='select title from books where book_id=\''.$_GET['book_id'].'\'';
        $bookname=Yii::app()->db->CreateCommand($sql)->queryScalar();
            $borrowtime=time();
            $date=date("Y-m-d",$borrowtime);
            $time=date("H:i:s",$borrowtime);
            $back=$borrowtime+7*60*60*24;
            $backdate=date("Y-m-d",$back);
            $backtime=date("H:i:s",$back);
            //echo "dateis[$date]timeis[$time]";
        $model = new Borrow();
        $model->book_id=$_GET['book_id'];
        $model->user_id=$userid;
        $model->book_title=$bookname;
        $model->borrow_date=$date;
        $model->borrow_time=$time;
        $model->back_date=$backdate;
        $model->back_time=$backtime;
        if($model->save() ==false)
            return false;
        $leave_number--;
        $update='update books set leave_number='.$leave_number.',borrowtime=\''.date("Y-m-d H:i:s",time()).'\' where book_id=\''.$_GET['book_id'].'\'';
        Yii::app()->db->CreateCommand($update)->execute();

        $this->render('success',array(
            'model'=>$this->loadModel($_GET['book_id']),
            'stat'=>'您已借书成功',
        ));
        }
        else{
            $this->render('noborr',array(
                'model'=>$this->loadModel($_GET['book_id']),
                'stat'=>'此书已借完!!!',
            ));
        }


    }



    public function actionBack()
    {
        $sql='select userid from users where username=\''.$_GET['user'].'\'';
        $userid=Yii::app()->db->CreateCommand($sql)->queryScalar();
        $sql='select 1 from borrow where book_id=\''.$_GET['book_id'].'\' and user_id=\''.$userid.'\'';
        $borrowed=Yii::app()->db->CreateCommand($sql)->queryScalar();
        if($borrowed==1)
        {
            $sql='select id from borrow where user_id=\''.$userid.'\' and book_id='.$_GET['book_id'];
            $id=Yii::app()->db->CreateCommand($sql)->queryScalar();
            $delete='delete from borrow where book_id=\''.$_GET['book_id'].'\' and  id='.$id.' and user_id=\''.$userid.'\'';
            $sql='select leave_number from books where book_id=\''.$_GET['book_id'].'\'';
            $leave_number=Yii::app()->db->CreateCommand($sql)->queryScalar();
            $leave_number++;
            $update='update books set leave_number=\''.$leave_number.'\' where book_id=\''.$_GET['book_id'].'\'';
            Yii::app()->db->CreateCommand($update)->execute();
            Yii::app()->db->CreateCommand($delete)->execute();
            $this->render('back',array(
                'model'=>$this->loadModel($_GET['book_id']),
                'stat'=>'本书已还',
            ));
        }
        else{
            $this->render('noborr',array(
                'model'=>$this->loadModel($_GET['book_id']),
                'stat'=>'您没有借过这本书!!!',
            ));
        }


    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Books('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Books']))
			$model->attributes=$_GET['Books'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Books the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Books::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Books $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='books-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
