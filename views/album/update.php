<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    ['label'=>'List Album', 'url'=>['/album']],
    ['label'=>'Create Album', 'url'=>['/album/create']],
    ['label'=>'View Album', 'url'=>['/album/view', 'id'=>$model->id]],
    ['label'=>'Manage Album', 'url'=>['/album/admin']],
];
?>

<h1>Update Album <?php echo $model->name; ?></h1>

<?php $this->renderPartial('/album/_form', ['model'=>$model]); ?>