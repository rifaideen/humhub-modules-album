<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => ['/album/index','uguid'=>$user->guid,'username'=>$user->username]
    ],
    [
      'label' => 'Create Album',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin','uguid'=>$user->guid,'username'=>$user->username]
    ],
];
?>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Create</strong> Album</div>
    <div class="panel-body">
        <?php $this->renderPartial('/album/_form', ['model'=>$model]); ?>
    </div>
</div>