<?php
/**
 * Render Album via ajax on Wall.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class WallentryController extends Controller
{
    
        public $defaultAction = 'view';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
            return [
                'accessControl', // perform access control for CRUD operations
                'ajaxOnly'
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            echo $this->renderPartial('/album/ajaxView',[
                'model'=>$this->loadModel($id),
            ],true);
	}

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Album the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            $model = Album::model()->findByPk($id);
            if ($model===null) {
                    throw new CHttpException(404,'The requested album does not exist.');
            }
            return $model;
	}
}
