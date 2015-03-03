<?php
/**
 * Handles Album Update operation.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class UpdateController extends ContentContainerController
{
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];

        public $defaultAction = 'update';
        
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $user = $this->getUser();
            $model=$this->loadModel($id);

            if (!$model->canEdit()) {
                throw new CHttpException(403,'You are not allowed to perform this action');
            }
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Album']))
            {
                    $model->attributes = Yii::app()->input->stripClean($_POST['Album']);
                    if($model->save())
                            $this->redirect(['/album/view','id'=>$model->id,'username'=>$user->username,'uguid'=>$user->guid]);
            }

            $this->render('/album/update',[
                    'model'=>$model,
            ]);
	}
        
        /**
         * Update Album Cover Image.
         * @param int $id
         * @throws CHttpException
         */
        public function actionCover($id)
        {
            $model = $this->loadModel($id);
            $model->scenario = 'update-cover';
            $user = $this->getUser();
            if (!$model->canEdit()) {
                throw new CHttpException(403,'You are not allowed to perform this action');
            }
            
            if (isset($_POST['Album'])) {
                $model->attributes = $_POST['Album'];
                if ($model->validate('image')) {
                    if ($model->cover instanceof PublicFile) {
                        $model->cover->delete();
                    }
                    PublicFile::attachPrecreated($model, $model->image);
                    $this->redirect(['/album/view','id'=>$model->id,'username'=>$user->username,'uguid'=>$user->guid]);
                }
            }
            
            $this->render('/album/cover',compact('model','user'));
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
            if ($model===null) {
                    throw new CHttpException(404,'The requested page does not exist.');
            }
            return $model;
	}
}
