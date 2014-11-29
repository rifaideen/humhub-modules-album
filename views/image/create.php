<?php
/* @var $this ImageController */
/* @var $model AlbumImage */
/* @var $album Album */

$this->menu = [
    [
      'label' => 'Album Details',
      'url' => ['/album/details','id'=>$album->id]
    ],
    [
      'label' => 'Add Image',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'View Album',
      'url' => ['/album/view','id'=>$album->id]
    ],
    [
      'label' => 'List Album',
      'url' => ['/album'],
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create']
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin'],
    ],
];
?>

<h1>Create Album Image</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>