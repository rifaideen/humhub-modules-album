<?php
/* @var $this AlbumController */
/* @var $model Album */
?>
<?php
$am = Yii::app()->assetManager;
$cs = Yii::app()->clientScript;
$assets = $this->assetsUrl;
$cs->registerCssFile("$assets/css/normalize.css");
$cs->registerCssFile("$assets/css/demo.css");
$cs->registerCssFile("$assets/css/component.css");
?>
<script src="<?= $assets ?>/js/modernizr.min.js"></script>
<section id="photostack-<?= $model->id ?>" class="photostack">
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
<br/>
<script src="<?= $assets ?>/js/classie.js"></script>
<script src="<?= $assets ?>/js/photostack.js"></script>
<script>
        // [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
        new Photostack( document.getElementById( "photostack-<?= $model->id ?>" ), {
                callback : function( item ) {
                        //console.log(item)
                }
        } );
</script>