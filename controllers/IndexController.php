<?php
/**
 * List Albums with name and description.
 *
 * @author rifaideen
 */
class IndexController extends Controller
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $criteria = new CDbCriteria();
                $criteria->condition = 't.created_by = :creater';
                $criteria->params = [':creater' => Yii::app()->user->id];
                //$criteria->with = ['cover'];
		$dataProvider=new CActiveDataProvider('Album',[
                    'criteria' => $criteria
                ]);
		$this->render('/album/index',[
                    'dataProvider'=>$dataProvider,
		]);
	}
}
