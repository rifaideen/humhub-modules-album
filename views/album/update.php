<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
	array('label'=>'View Album', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1>Update Album <?php echo $model->id; ?></h1>

<?php $this->renderPartial('/album/_form', array('model'=>$model)); ?>