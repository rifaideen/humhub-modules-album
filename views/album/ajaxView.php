<?php
/* @var $this AlbumController */
/* @var $model Album */
?>
<?php
$assets = $this->module->assetsUrl;
?>
<script src="<?= $assets ?>/js/modernizr.min.js"></script>
    <section id="photostack" class="photostack">
        <div>
            <figure>
                <a class="photostack-img"><img src="<?= $model->cover != null ? $model->cover->url : $assets . '/img/' . rand(1, 12) . '.jpg' ?>" alt="Album Cover" style="width: 240px;height: 240px;"/></a>
                <figcaption>
                    <h2 class="photostack-title"><?= $model->name ?></h2>
                    <div class="photostack-back">
                        <p><?= $model->description; ?></p>
                    </div>
                </figcaption>
            </figure>
            <?php foreach ($model->images as $file): ?>
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
<div class="lead">
    <?= $model->name ?>
</div>
<p>
    <?= $model->description ?>
</p>
<script src="<?= $assets ?>/js/classie.js"></script>
<script src="<?= $assets ?>/js/photostack.js"></script>
<script>
        new Photostack( document.getElementById( 'photostack' ) );
</script>