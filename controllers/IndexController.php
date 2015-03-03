<?php
/**
 * List Albums with name and description.
 *
 * @author rifaideen <rifajas@gmail.com>
 */
class IndexController extends ContentContainerController
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
		
		$this->checkContainerAccess();
		$user = $this->getUser();
                $criteria = new CDbCriteria();
                $criteria->condition = 't.created_by = :creater';
                $criteria->params = [':creater' => $user->id];
                $dataProvider=new CActiveDataProvider('Album',[
        	'criteria' => $criteria,
                    'pagination' => [
                        'pageSize' => 10
                     ]
                ]);

		$this->render('/album/index',[
        	'dataProvider'=>$dataProvider,
                    'user' => $user
		]);
	}
}
