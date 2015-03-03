<?php
/* @var $this AlbumController */
/* @var $model Album */
?>

<div class="panel panel-default">
    <div class="panel-heading">Update Album - <strong><?php echo $model->name; ?></strong></div>
    <div class="panel-body">
        <?php $this->renderPartial('/album/_form', ['model'=>$model]); ?>
    </div>
</div>