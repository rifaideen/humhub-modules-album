<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => ['/album/index']
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create'],
    ],
    [
      'label' => 'Manage Albums',
      'url' => '#',
      'active' => true
    ],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#album-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Albums</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'album-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'description',
		'created_at',
		'updated_at',
		'created_by',
		/*
		'updated_by',
		*/
		array(
			'class'=>'CButtonColumn',
                        'viewButtonUrl' => '["/album/view","id"=>$data->id]',
                        'updateButtonUrl' => '["/album/update","id"=>$data->id]',
                        'deleteButtonUrl' => '["/album/delete","id"=>$data->id]'
		),
	),
)); ?>
