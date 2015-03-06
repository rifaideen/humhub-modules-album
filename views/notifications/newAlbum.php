<li class="<?php if (!$notification->seen) : ?>new<?php endif; ?>">
    <a href="<?php echo $notification->getUrl(); ?>">
        <div class="media">
            <!-- show user image -->
            <img class="media-object img-rounded pull-left"
                 data-src="holder.js/32x32" alt="32x32"
                 style="width: 32px; height: 32px;"
                 src="<?php echo $notification->creator->getProfileImage()->getUrl(); ?>">

            <!-- show content -->
            <div class="media-body">
                <div class="row">
                    <div class="col-md-9">
                        <?php
                        echo '<strong>' . CHtml::encode($creator->displayName) . '</strong> created new album ';
                        echo NotificationModule::formatOutput($targetObject->getContentTitle());
                        ?>
                        <br>
                        <span class="time"
                          title="<?php echo $notification->created_at; ?>"><?php echo $notification->created_at; ?></span>
                        <?php if (!$notification->seen) : ?> 
                            <span class="label label-danger"><?php echo Yii::t('NotificationModule.views_notificationLayout', 'New'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <img class="media-object img-rounded pull-left" data-src="holder.js/32x32" alt="32x32" style="width: 80px; height: 61px;" src="<?= $targetObject->coverImage ?>">
                    </div>
                </div>
            </div>
        </div>
    </a>    
</li>