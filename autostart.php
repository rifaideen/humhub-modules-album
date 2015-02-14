<?php

Yii::app()->moduleManager->register([
    'id' => 'album',
    'class' => 'application.modules.album.AlbumModule',
    'import' => [
        'application.modules.album.*',
        'application.modules.album.models.*'
    ],
    // Events to Catch 
    'events' => [
        ['class' => 'ProfileMenuWidget', 'event' => 'onInit', 'callback' => ['AlbumModule', 'onProfileMenuInit']],
    ],
    'urlManagerRules' => [
        [
            'class' => 'album.components.AlbumUrlRule'
        ]
    ]
]);
?>