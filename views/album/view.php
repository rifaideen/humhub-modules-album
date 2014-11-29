<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'Album Details',
      'url' => ['//album/details','id'=>$model->id]
    ],
    [
      'label' => 'Add Image',
      'url' => ['image/create','id'=>$model->id]
    ],
    [
      'label' => 'View Album',
      'url' => '#',
      'active' => true
    ],
    [
      'label' => 'Update Album',
      'url' => ['/album/update','id'=>$model->id]
    ],
    [
      'label' => 'List Albums',
      'url' => ['/album/index']
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
<?php
$am = Yii::app()->assetManager;
$cs = Yii::app()->clientScript;
$assets = $am->publish(dirname(__FILE__).'/../../assets');
$cs->registerCssFile("$assets/css/normalize.css");
$cs->registerCssFile("$assets/css/demo.css");
$cs->registerCssFile("$assets/css/component.css");
?>
<script src="<?= $assets ?>/js/modernizr.min.js"></script>
<section id="photostack" class="photostack">
    <div>
        <figure>
            <a class="photostack-img"><img src="<?= $model->cover != null ? $model->cover->url : $assets.'/img/'.rand(1,12).'.jpg' ?>" alt="Album Cover" style="width: 240px;height: 240px;"/></a>
            <figcaption>
                <h2 class="photostack-title"><?= $model->name ?></h2>
                <div class="photostack-back">
                    <p><?= $model->description; ?></p>
                </div>
            </figcaption>
        </figure>
<?php foreach($model->images as $file): ?>
        <figure>
            <a class="photostack-img"><img src="<?= $file->image->url ?>" alt="img05" style="width: 240px;height: 240px;"/></a>
            <figcaption>
                <h2 class="photostack-title"><?= $file->name; ?></h2>
                <div class="photostack-back">
                    <p><?= $file->description ?></p>
                </div>
            </figcaption>
        </figure>
<?php endforeach; ?>
    </div>
</section>
<script src="<?= $assets ?>/js/classie.js"></script>
<script src="<?= $assets ?>/js/photostack.js"></script>
<script>
        // [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
        new Photostack( document.getElementById( 'photostack' ), {
                callback : function( item ) {
                        //console.log(item)
                }
        } );
</script>