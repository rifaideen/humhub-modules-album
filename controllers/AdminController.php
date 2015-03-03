<?php
/**
 * Displays Albums in a Gridview.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class AdminController extends ContentContainerController
{
    
	public $subLayout = "application.modules.album.views._layout";
        
        public $menu = [];
        
        public $defaultAction = 'adminone';

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
	 * Manages all models.
	 */
	public function actionAdminone()
	{
            $user = $this->getUser();

            /**
             * Though we made this action to display the users own album without 
             * considering the uguid received via GET parameter.
             * we should throw the exception if current user id is different 
             * from $user->id we fetched based on guid GET parameter.
             */
            if ($user->id != Yii::app()->user->id) {
                    throw new CHttpException(403, 'You can manage your albums only.');
            }

            $this->subLayout = "album.views._layout";
            $model=new Album('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Album'])) {
                $model->attributes=$_GET['Album'];
            }

            $this->render('/album/admin',[
                    'model'=>$model,
                    'user'=>$user
            ]);
	}
}
