<?php

/**
 * Displays Album Settings form.
 * 
 * @author rifaideen <rifajas@gmail.com>
 */
class SettingController extends Controller
{
        public function filters()
	{
            return [
		'accessControl',
            ];
	}
        
        public function accessRules()
        {
            return  [
                ['allow',
                    'expression' => 'Yii::app()->user->isAdmin()'
                ],
                ['deny', // deny all users
                    'users' => array('*'),
                ],
            ];
        }
        
	public function actionIndex()
	{
            $model = new AlbumSettings;
            $model->allowedExtensions = HSetting::get('allowedExtensions','album');
            if (isset($_POST['AlbumSettings'])) {
                $model->attributes = $_POST['AlbumSettings'];
                if ($model->validate()) {
                    HSetting::set('allowedExtensions',$model->allowedExtensions,'album');
                    // set flash message
                    Yii::app()->user->setFlash('data-saved', 'Saved');
                    $this->redirect(Yii::app()->createUrl('//album/setting'));
                }
            }
            
            $this->render('index', compact('model'));
	}
}