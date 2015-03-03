<?php
/* @var $this Controller */
/* @var $model Album */
/* @var $file PublicFile */
Yii::app()->clientScript->registerCss('grid-image-fix','.grid img {height:120px;width:120px;} .button-column img {height: inherit !important;width: inherit !important;}');

$uguid = Yii::app()->user->guid;
$username = Yii::app()->user->name;

$this->menu = [
    [
      'label' => 'Album Details',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Add Image',
      'url' => ['/album/image/create','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'View Album',
      'url' => ['/album/view','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'Update Album',
      'url' => ['/album/update','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'Update Album Cover',
      'url' => ['/album/update/cover','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'List Album',
      'url' => ['/album/index','username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create','username'=>$username,'uguid'=>$uguid]
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin','username'=>$username,'uguid'=>$uguid]
    ],
];
?>
<div class="panel" style="border: 2px solid #7191A8;">
    <div class="panel-heading">Album Details</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img class="img-thumbnail" src="<?php echo $model->coverImage; ?>">
            </div>
            <div class="col-md-9">
                <?php echo CHtml::link(CHtml::encode($model->name),['/album/view','id'=>$model->id,'username'=>$username,'uguid'=>$uguid]); ?>
                <hr>
                <?php echo CHtml::encode($model->description); ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">Images</div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', [
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'table table-striped',
            'summaryText'=>'Displaying {start}-{end} of {count} images.',
            'htmlOptions' => [
                'class' => 'grid',
            ],
            'columns' => [
                [
                    'type' => 'raw',
                    'value' => 'CHtml::image($data->image->url,"loading",array("class"=>"img-thumbnail"))',
                ],
//                'image.url:image:Image',
                'name',
                'description',
                [
                    'class' => 'CButtonColumn',
                    'updateButtonUrl' => '["image/update","id"=>$data->id]',
                    'deleteButtonUrl' => '["image/delete","id"=>$data->id]',
                    'updateButtonLabel' => '<i class="fa fa-pencil"></i>',
                    'updateButtonOptions' => [
                        'title' => 'Update'
                    ],
                    'deleteButtonLabel' => '<i class="fa fa-trash"></i>',
                    'deleteButtonOptions' => [
                        'title' => 'Delete'
                    ],
                    'updateButtonImageUrl' => false,
                    'deleteButtonImageUrl' => false,
                    'template' => '{update} {delete}'
                ]
            ]
        ]);
        ?>  
    </div>