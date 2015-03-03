<?php
/**
 * Handles Album Image related operations as well as file upload operations.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class ImageController extends Controller
{
        
        public $subLayout = "application.modules.album.views._layout";

        public $menu = [];
        
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
            $album = Album::model()->findByPk($id);

            if ($album === null) {
                throw new CHttpException(404,'The requested album does not exists.');
            }

            $model=new AlbumImage;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['AlbumImage']))
            {
                    $model->attributes=$_POST['AlbumImage'];
                    $model->album_id = $album->id;
                    if($model->save()) {
                        PublicFile::attachPrecreated($model, $model->_image);
                        $this->redirect(['/album/details','id'=>$album->id]);
                    }
            }

            $this->render('create',[
                'model'=>$model,
                'album'=>$album
            ]);
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

            if(isset($_POST['AlbumImage']))
            {
                    $model->attributes=$_POST['AlbumImage'];
                    if ($model->save()) {
                        $this->redirect(['/album/details','id'=>$model->album->id,'username'=>Yii::app()->user->name]);
                    }
            }

            $this->render('update',[
                'model'=>$model,
                'album'=>$model->album
            ]);
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
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
            }
	}

        /**
         * Action which handles file uploads
         *
         * The result is an json array of all uploaded files.
         */
        public function actionUpload()
        {
            // Object which the uploaded file(s) belongs to (optional)
            $object = null;
            $objectModel = Yii::app()->request->getParam('objectModel');
            $objectId = Yii::app()->request->getParam('objectId');
            if ($objectModel != "" && $objectId != "") {
                $givenObject = $objectModel::model()->findByPk($objectId);
                // Check if given object is HActiveRecordContent or HActiveRecordContentAddon and can be written by the current user
                if ($givenObject !== null && ($givenObject instanceof HActiveRecordContent || $givenObject instanceof HActiveRecordContentAddon) && $givenObject->content->canWrite()) {
                    $object = $givenObject;
                }
            }

            $files = [];
            $cFile = CUploadedFile::getInstanceByName('files');
            $files[0] = $this->handleFileUpload($cFile, $object);

            return $this->renderJson(['files' => $files]);
        }

        /**
         * Handles a single upload by given CUploadedFile and returns an array
         * of informations.
         *
         * The 'error' attribute of the array, indicates there was an error.
         *
         * Informations on error:
         *       - error: true
         *       - errorMessage: some message
         *       - name: name of the file
         *       - size: file size
         *
         * Informations on success:
         *      - error: false
         *      - name: name of the uploaded file
         *      - size: file size
         *      - guid: of the file
         *      - url: url to the file
         *      - thumbnailUrl: url to the thumbnail if exists
         *
         * @param type $cFile
         * @return Array Informations about the uploaded file
         */
        protected function handleFileUpload($cFile, $object = null)
        {
            $output = [];

            $file = new PublicFile();
            $file->setUploadedFile($cFile);

            if ($object != null) {
                $file->object_id = $object->getPrimaryKey();
                $file->object_model = get_class($object);
            }

            if ($file->validate() && $file->save()) {
                $output['error'] = false;
                $output['guid'] = $file->guid;
                $output['name'] = $file->file_name;
                $output['title'] = $file->title;
                $output['size'] = $file->size;
                $output['mimeIcon'] = HHtml::getMimeIconClassByExtension($file->getExtension());
            } else {
                $output['error'] = true;
                $output['errors'] = $file->getErrors();
            }

            $output['name'] = $file->file_name;
            $output['size'] = $file->size;
            $output['deleteUrl'] = "";
            $output['deleteType'] = "";
            $output['url'] = "";
            $output['thumbnailUrl'] = "";

            return $output;
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AlbumImage the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
            $model=AlbumImage::model()->with('image')->findByPk($id);
            if ($model===null) {
                    throw new CHttpException(404,'The requested page does not exist.');
            }
            return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AlbumImage $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
            if(isset($_POST['ajax']) && $_POST['ajax']==='album-image-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
	}
}
