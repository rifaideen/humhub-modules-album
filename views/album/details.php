<?php
/* @var $this Controller */
/* @var $model Album */
/* @var $file PublicFile */
Yii::app()->clientScript->registerCss('grid-image-fix','.grid img {height:120px;width:120px;} .button-column img {height: inherit !important;width: inherit !important;}');
$this->menu = [
    [
      'label' => 'Album Details',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Add Image',
      'url' => ['/album/image/create','id'=>$model->id]
    ],
    [
      'label' => 'View Album',
      'url' => ['/album/view','id'=>$model->id]
    ],
    [
      'label' => 'Update Album',
      'url' => ['/album/update','id'=>$model->id]
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
<div class="panel" style="border: 2px solid #7191A8;">
    <div class="panel-heading">Album</div>
    <div class="panel-body">
        <?php $this->renderPartial('/album/_view',['data'=>$model]); ?>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">Images</div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', [
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'table table-striped',
            'htmlOptions' => [
                'class' => 'grid',
            ],
            'columns' => [
                'image.url:image:Image',
                'name',
                'description',
                [
                    'class' => 'CButtonColumn',
                    //'viewButtonUrl' => '["image/view","id"=>$data->id]',
                    'updateButtonUrl' => '["image/update","id"=>$data->id]',
                    'deleteButtonUrl' => '["image/delete","id"=>$data->id]',
                    'template' => '{update} {delete}'
                ]
            ]
        ]);
        ?>  
    </div>
</div>