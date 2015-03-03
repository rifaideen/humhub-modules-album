<?php
/**
 * Handles Album Image related operations as well as file upload operations.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class DetailsController extends Controller
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

        public function actionIndex($id)
        {
            $model = Album::model()->findByAttributes(['id'=>$id,'created_by'=>Yii::app()->user->id]);

            if ($model === null) {
                throw new CHttpException(404,'The requested album does not exists.');
            }

            $this->subLayout = "application.modules.album.views._layout";
            
            $criteria = new CDbCriteria([
                'condition'=>'album_id = '.$model->id,
                'with'=>'image'
            ]);
            $dataProvider = new CActiveDataProvider('AlbumImage',['criteria'=>$criteria]);

            $this->render('/album/details',[
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }
}
