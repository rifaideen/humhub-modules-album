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

<h1>Albums</h1>

<?php $this->widget('zii.widgets.CListView', [
	'dataProvider'=>$dataProvider,
	'itemView'=>'/album/_view',
]); ?>
