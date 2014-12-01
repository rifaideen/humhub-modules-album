<?php
/**
 * Displays Albums in a Gridview.
 *
 * @author rifaideen
 */
class AdminController extends Controller
{
    
	public $subLayout = "application.modules.album.views._layout";
        
        public $menu = [];
        
        public $defaultAction = 'admin';

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
	public function actionAdmin()
	{
            $this->subLayout = "application.modules.album.views._layout";
            $model=new Album('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Album'])) {
                $model->attributes=$_GET['Album'];
            }

            $this->render('/album/admin',[
                    'model'=>$model,
            ]);
	}
}
