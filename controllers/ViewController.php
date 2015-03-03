<?php
/**
 * View Album In a nice layout with album details as first slide.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class ViewController extends ContentContainerController
{
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];

        public $defaultAction = 'view';
        
    /**
	 * @return array action filters
	 */
	public function filters()
	{
            return [
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete', // we only allow deletion via POST request
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
            
            if (Yii::app()->request->isAjaxRequest) {
                echo $this->renderPartial('/album/ajaxView',[
                    'model'=>$this->loadModel($id),
                    'user'=>$this->getUser()
                ],true);
            } else {
                $this->render('/album/view',[
                    'model'=>$this->loadModel($id),
                ]);
            }
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
			$user = $this->getUser();
            $model = Album::model()->findByAttributes(['id'=>$id,'created_by'=>$user->id]);
            if ($model===null) {
                    throw new CHttpException(404,'The requested album does not exist.');
            }
            return $model;
	}
}
