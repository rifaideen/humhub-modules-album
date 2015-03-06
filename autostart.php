<?php

Yii::app()->moduleManager->register([
    'id' => 'album',
    'class' => 'application.modules.album.AlbumModule',
    'import' => [
        'application.modules.album.*',
        'application.modules.album.models.*',
        'application.modules.album.notifications.AlbumNotification'
    ],
    // Events to Catch 
    'events' => [
        ['class' => 'ProfileMenuWidget', 'event' => 'onInit', 'callback' => ['AlbumModule', 'onProfileMenuInit']],
        ['class' => 'AdminMenuWidget', 'event' => 'onInit', 'callback' => ['AlbumModule', 'onAdminMenuInit']],
    ],
    'urlManagerRules' => [
        [
            'class' => 'application.modules.album.components.AlbumUrlRule'
        ]
    ]
]);
?>