<?php
/**
 * Handles Album creation.
 *
 * @author rifaideen
 */
class CreateController extends Controller
{
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];

        public $defaultAction = 'create';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
	 * Creates a new album with optional album cover.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Album;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if ($model->save()) {
                                PublicFile::attachPrecreated($model, Yii::app()->request->getParam('cover'));
				$this->redirect(array('/album/view','id'=>$model->id));
                        }
		}

		$this->render('/album/create',array(
			'model'=>$model,
		));
	}
}
