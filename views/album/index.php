<?php
/* @var $this AlbumController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4">
                <h3 class="panel-title">
                    <i class="fa fa-image"></i> Albums
                </h3>
            </div>
            <?php if ($user->id == Yii::app()->user->id): ?>
            <div class="col-md-3  col-md-offset-1">
                <a href="<?= $this->createUrl('/album/create',['username'=>$user->username,'uguid'=>$user->guid]) ?>" class="btn btn-info">
                    <i class="fa fa-plus"></i> Create Album
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?= $this->createUrl('/album/admin',['username'=>$user->username,'uguid'=>$user->guid]) ?>" class="btn btn-warning">
                    <i class="fa fa-chevron-right"></i> Manage Albums
                </a>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            $this->widget('zii.widgets.CListView', [
                'dataProvider' => $dataProvider,
                'itemView' => '/album/_view',
                'viewData' => [
                    'user' => $user
                ],
                'summaryText' => false,
                'enableSorting' => false,
                'pagerCssClass' => 'album-pagination',
                'pager' => [
                    'cssFile' => false,
                    'maxButtonCount' => 5,
                    'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                    'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                    'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                    'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                    'header' => '<div class="clearfix"></div><div class="pagination-container">',
                    'footer' => '</div>',
                    'htmlOptions' => array('class' => 'pagination'),
                ]
            ]);
            ?>    
        </div>
    </div>
</div>