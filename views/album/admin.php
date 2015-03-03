<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => ['/album', 'username'=>$user->username]
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create','id'=>$user->id, 'username'=>$user->username,'uguid'=>$user->guid]
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
<div class="panel panel-default">
    <div class="panel-heading"><strong>Manage</strong> Albums</div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php $this->widget('zii.widgets.grid.CGridView', [
            'id'=>'album-grid',
            'itemsCssClass'=>'table table-bordered table-hover table-striped',
            'summaryText'=>'Displaying {start}-{end} of {count} albums.',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>[
                'id',
                'name',
                'description',
                [
                    'header' => 'Created',
                    'value' => 'HHtml::timeAgo($data->created_at)',
                    'type'=>'html'
                ],
                [
                    'header' => 'Updated',
                    'value' => 'HHtml::timeAgo($data->updated_at)',
                    'type'=>'html'
                ],
                [
                    'class'=>'CButtonColumn',
                    'header' => 'Actions',
                    'viewButtonUrl' => '["/album/view","id"=>$data->id,"username"=>Yii::app()->user->name,"uguid"=>$data->owner->guid]',
                    'updateButtonUrl' => '["/album/update","id"=>$data->id,"username"=>Yii::app()->user->name,"uguid"=>$data->owner->guid]',
                    'deleteButtonUrl' => '["/album/delete","id"=>$data->id,"username"=>Yii::app()->user->name,"uguid"=>$data->owner->guid]',
                    'viewButtonLabel' => '<i class="fa fa-eye"></i>',
                    'viewButtonOptions' => [
                        'title' => 'View'
                    ],
                    'updateButtonLabel' => '<i class="fa fa-pencil"></i>',
                    'updateButtonOptions' => [
                        'title' => 'Update'
                    ],
                    'deleteButtonLabel' => '<i class="fa fa-trash"></i>',
                    'deleteButtonOptions' => [
                        'title' => 'Delete'
                    ],
                    'viewButtonImageUrl' => false,
                    'updateButtonImageUrl' => false,
                    'deleteButtonImageUrl' => false,
                    'template' => '{view} {update} {details} {delete}',
                    'buttons' => [
                        'details' => [
                            'label' => '<i class="fa fa-bars"></i>',
                            'options' => [
                                'title' => 'Details'
                            ],
                            'url' => '["/album/details","id"=>$data->id,"username"=>Yii::app()->user->name,"uguid"=>$data->owner->guid]',
                        ]
                    ]
                ],
            ],
        ]); 
        ?>
    </div>
</div>
