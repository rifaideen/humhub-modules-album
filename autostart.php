<?php

Yii::app()->moduleManager->register(array(
    'id' => 'album',
    'class' => 'application.modules.album.AlbumModule',
    'import' => array(
        'application.modules.album.*',
        'application.modules.album.models.*'
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('AlbumModule', 'onTopMenuInit')),
    ),
));
?>