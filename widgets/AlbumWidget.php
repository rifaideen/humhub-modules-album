<?php

/**
 * AlbumWidget is responsible of loading album in wall.
 * 
 * @author rifaideen
 */
class AlbumWidget extends HWidget
{
    public $album;
   
    /**
     * @todo Show basic info about album. upon clicking the album show the album in lighbox using ajax request.
     */
    public function run()
    {
        $this->render('album',array('model'=>$this->album));
    }
}
