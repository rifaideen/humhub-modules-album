<?php
/* @var $this AlbumController */
/* @var $data Album */
?>

<div class="row">
    <div class="col-md-4">
        <?php echo CHtml::link(CHtml::encode($data->name),['/album/view','id'=>$data->id]); ?>
    </div>
    <div class="col-md-8">
        <?php echo CHtml::encode($data->description); ?>
    </div>
</div>