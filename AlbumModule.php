<?php
/**
 * Displays Albums in a Gridview.
 *
 * @author rifaideen
 */
class AlbumModule extends HWebModule
{
    public $subLayout = "application.modules_core.dashboard.views._layout";
    
    public $defaultController = 'index';
    
    private $_assetsUrl;

    /**
     * Get Assets url for this module.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('album.assets')
            );
        }
        return $this->_assetsUrl;
    }
    
    /**
     * Add Album Menu on top of the site.
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Album',
            'url' => Yii::app()->createUrl('//album'),
            'icon' => '<i class="fa fa-image"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'album'),
            'sortOrder' => 800,
        ]);
    }
    
    /**
     * Create new folder to save albums on enabled.
     */
    public function enable()
    {
        parent::enable();
        
        $path = Yii::getPathOfAlias('webroot') .
                DIRECTORY_SEPARATOR . "uploads" .
                DIRECTORY_SEPARATOR . 'album';
        if (!is_dir($path)) {
            mkdir($path,0777,true);
        }
        
    }
    
    /**
     * Delete All User Created files
     */
    public function disable()
    {
        if (parent::disable()) {
            foreach (Album::model()->findAll() as $album) {
                $album->delete();
            }
            return true;
        }

        return false;
    }
}
