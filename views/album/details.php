<?php
/* @var $this Controller */
/* @var $model Album */
/* @var $file PublicFile */
Yii::app()->clientScript->registerCss('grid-image-fix','.grid img {height:120px;width:120px;} .button-column img {height: inherit !important;width: inherit !important;}');

$uguid = Yii::app()->user->guid;

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
      'url' => ['/album/view/view','id'=>$model->id,'uguid'=>$uguid]
    ],
    [
      'label' => 'Update Album',
      'url' => ['/album/update/update','id'=>$model->id,'uguid'=>$uguid]
    ],
    [
      'label' => 'List Album',
      'url' => ['/album','uguid'=>$uguid]
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create','uguid'=>$uguid]
    ],
    [
      'label' => 'Manage Albums',
      'url' => ['/album/admin','uguid'=>$uguid]
    ],
];
?>
<div class="panel" style="border: 2px solid #7191A8;">
    <div class="panel-heading">Album Details</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <?php echo CHtml::link(CHtml::encode($model->name),['/album/view','id'=>$model->id,'uguid'=>$uguid]); ?>
            </div>
            <div class="col-md-9">
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