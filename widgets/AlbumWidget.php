<?php

/**
 * AlbumWidget is responsible of loading album in wall.
 * 
 * @author rifaideen
 */
class AlbumWidget extends HWidget
{
    public $album;
    
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
     * @todo Show basic info about album. upon clicking the album show the album in lighbox using ajax request.
     */
    public function run()
    {
        $this->render('album',['model'=>$this->album,'id'=>$this->album->id]);
    }
}
