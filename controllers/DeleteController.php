<?php
/**
 * Handles Album Delete operations.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class DeleteController extends Controller
{
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];

        public $defaultAction = 'delete';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
            return [
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete'
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $album = $this->loadModel($id);
            
            if (!$album->canDelete()) {
                throw new CHttpException(301,'You are not allowed to delete this item');
            }
            
            $album->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
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
            $model=Album::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
}
