<?php
/**
 * Handles Album creation.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class CreateController extends ContentContainerController
{
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];

        public $defaultAction = 'create';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return [
                    'accessControl', // perform access control for CRUD operations
		];
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
                    [
                        'allow',
                        'users'=>['@'],
                    ],
                    [
                        'deny',  // deny all users
                        'users'=>['*'],
                    ],
		];
	}
        
        /**
	 * Creates a new album with optional album cover.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$user = $this->getUser();

		if ($user->id != Yii::app()->user->id) {
			throw new CHttpException(403, 'You can create album only on your profile.');
		}

		$this->subLayout = "application.modules.album.views._layout";
		$model = new Album;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
                        $_POST = Yii::app()->input->stripClean($_POST);
                        $_POST['containerGuid'] = Yii::app()->user->guid;
                        $_POST['containerClass'] = 'User';
                        $model->content->populateByForm();
			$model->attributes=$_POST['Album'];
			if ($model->save()) {
                                PublicFile::attachPrecreated($model, Yii::app()->request->getParam('cover'));
				$this->redirect(['/album/view','id'=>$model->id,'username'=>$user->username,'uguid'=>$user->guid]);
                        }
		}

		$this->render('/album/create',[
                    'model'=>$model,
                    'user'=>$user
		]);
	}
}
