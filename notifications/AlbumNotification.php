<?php

/**
 * AlbumNotifications sends notification to followers.
 *
 * @author rifaideen<rifajas@gmai.com>
 */
class AlbumNotification extends Notification
{
    public $webView = "application.modules.album.views.notifications.newAlbum";
    public $mailView = "application.modules.album.views.notifications.newAlbum_mail";
    
    /**
     * Fires this notification
     *
     * @param Album $like
     */
    public static function fire($album)
    {
        foreach ($album->owner->getFollowers(null, true) as $user) {

            $notification = new Notification();
            $notification->class = "AlbumNotification";
            $notification->user_id = $user->id;

            $notification->source_object_model = "Album";
            $notification->source_object_id = $album->id;

            $notification->target_object_model = 'Album';
            $notification->target_object_id = $album->id;

            $notification->save();
        }
    }
}
