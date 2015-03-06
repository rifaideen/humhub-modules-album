<?php $this->beginContent('application.modules_core.notification.views.notificationLayoutMail', array('notification' => $notification, 'showSpace' => false)); ?>

<?php 
echo '<strong>' . CHtml::encode($creator->displayName) . '</strong> created new album ' . NotificationModule::formatOutput($targetObject->getContentTitle());
?>
<?php $this->endContent(); ?>