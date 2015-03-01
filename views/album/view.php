<?php
/* @var $this AlbumController */
/* @var $model Album */
?>
<?php
$assets = $this->module->assetsUrl;
$cs = Yii::app()->clientScript;
$cs->registerCssFile("$assets/css/normalize.css");
$cs->registerCssFile("$assets/css/demo.css");
$cs->registerCssFile("$assets/css/component.css");
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
    <!-- show controls -->
    <?php $this->widget('application.modules_core.wall.widgets.WallEntryAddonWidget', array('object' => $model)); ?>

<script src="<?= $assets ?>/js/classie.js"></script>
<script src="<?= $assets ?>/js/photostack.js"></script>
<script>
        new Photostack( document.getElementById( 'photostack' ) );
        $(document).ready(function() {
            $("#comment_create_post_Album_<?= $model->id ?>").css({
                left: "0px",
                opacity:"100",
                margin: "5px"
            });
            $("#comment_create_post_Album_<?= $model->id ?>").val("Comment");
        });
</script>