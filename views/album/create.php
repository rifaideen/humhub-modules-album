<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => ['/album/index','uguid'=>$user->guid]
    ],
    [
      'label' => 'Create Album',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin','uguid'=>$user->guid],
    ],
];
?>

<h1>Create Album</h1>

<?php $this->renderPartial('/album/_form', ['model'=>$model]); ?>