<?php
/* @var $this AlbumController */
/* @var $model Album */
?>

<h1>Update Album <?php echo $model->name; ?></h1>

<?php $this->renderPartial('/album/_form', ['model'=>$model]); ?>