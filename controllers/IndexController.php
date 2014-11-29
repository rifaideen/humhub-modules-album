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
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                //$this->subLayout = null;
		$dataProvider=new CActiveDataProvider('Album');
		$this->render('/album/index',array(
			'dataProvider'=>$dataProvider,
		));
	}
}
