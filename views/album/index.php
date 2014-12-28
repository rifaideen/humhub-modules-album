<?php
/* @var $this AlbumController */
/* @var $dataProvider CActiveDataProvider */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => '#',
      'active' => true
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

<!--<h1>Albums</h1>-->
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4">
                <h3 class="panel-title">
                    <i class="fa fa-image"></i> Albums
                </h3>
            </div>
            <div class="col-md-2 col-md-offset-4">
                <a href="<?= $this->createUrl('/album/create') ?>" class="btn btn-info">
                    <i class="fa fa-plus"></i> Create Album
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?= $this->createUrl('/album/admin') ?>" class="btn btn-warning">
                    <i class="fa fa-chevron-right"></i> Manage Albums
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            $this->widget('zii.widgets.CListView', [
                'dataProvider' => $dataProvider,
                'itemView' => '/album/_view',
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