<?php
/* @var $this AlbumController */
/* @var $data Album */
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img class="img-rounded" src="<?= $data->coverImage ?>">
        <div class="caption text-center">
            <h3><a href="<?= $this->createUrl('/album/view',['id'=>$data->id,'username'=>$user->username,'uguid'=>$user->guid]) ?>"><?= $data->name ?></a></h3>
        </div>
    </div>
</div>