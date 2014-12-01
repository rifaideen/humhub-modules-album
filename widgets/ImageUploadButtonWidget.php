<?php

Yii::import('application.modules_core.file.widgets.FileUploadButtonWidget');
/**
 * Description of ImageUploadButtonWidget
 *
 * @author rifaideen
 */
class ImageUploadButtonWidget extends FileUploadButtonWidget
{
    // Target controller/action that handles this image upload
    public $uploadTo = '//album/image/upload';
    
    /**
     * Ensure that imported javascript resources are included in the output
     */
    public function init()
    {
        $assetPrefix = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../resources', true, 0, defined('YII_DEBUG'));
        Yii::app()->clientScript->registerScriptFile($assetPrefix . '/fileuploader.js');
        Yii::app()->clientScript->setJavascriptVariable('fileuploader_error_modal_title', Yii::t('FileModule.widgets_FileUploadButtonWidget', '<strong>Upload</strong> error'));
        Yii::app()->clientScript->setJavascriptVariable('fileuploader_error_modal_btn_close', Yii::t('FileModule.widgets_FileUploadButtonWidget', 'Close'));
        Yii::app()->clientScript->setJavascriptVariable('fileuploader_error_modal_errormsg', Yii::t('FileModule.widgets_FileUploadButtonWidget', 'Could not upload File:'));
    }
    
    /**
     * Draws the Upload Button output.
     */
    public function run()
    {
        $objectModel = "";
        $objectId = "";
        if ($this->object !== null) {
            $objectModel = get_class($this->object);
            $objectId = $this->object->getPrimaryKey();
        }

        $this->render('fileUploadButton', [
            'fileListFieldName' => $this->fileListFieldName,
            'uploaderId' => $this->uploaderId,
            'objectModel' => $objectModel,
            'objectId' => $objectId,
            'uploadTo' => $this->uploadTo
        ]);
    }
}
