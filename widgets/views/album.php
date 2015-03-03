<?php
/* @var $this AlbumController */
/* @var $model Album */
?>
<?php
$am = Yii::app()->assetManager;
$cs = Yii::app()->clientScript;
$assets = $this->assetsUrl;
$cs->registerCssFile("$assets/css/component.css");
?>
<div class="panel panel-default post" id="album-<?php echo $id; ?>">
    <div id="album-<?= $id ?>-body" class="panel-body">
        <?php $this->beginContent('application.modules_core.wall.views.wallLayout', array('object' => $model)); ?>
            <a data-toggle="modal" data-target="#album-modal-<?= $id ?>">
                <img src="<?= $model->coverImage ?>" class="img-responsive">
            </a>
            <a href="<?php echo $this->createUrl('/album/view',array('id'=>$model->id,'username'=>$model->content->user->username,'uguid'=>$model->content->user->guid)); ?>">
                <h4><?= $model->name ?></h4>
            </a>
        <p>
            <?= $model->description ?>
        </p>
            <div class="modal fade" id="album-modal-<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-shown="false">
                <div class="modal-dialog" style="width: 900px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?= $model->name; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="loader"></div>
                            <div class="row album-content"></div>
                        </div>
                        <div class="modal-footer" style="display: none;">
                            created <?= HHtml::timeago($model->created_at); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php $this->endContent(); ?>
    </div>
</div>
<script>
    $('#album-modal-<?= $id ?>').on('shown.bs.modal', function (e) {
        $.ajax({
            url: "<?= $this->createUrl('/album/wallentry',['id'=>$id]) ?>",
            success: function(data){
                $('#album-modal-<?= $id ?>' + ' .loader').hide();
                $('#album-modal-<?= $id ?>' + ' .album-content').html(data);
                $('#album-modal-<?= $id ?>' + ' .modal-footer').show();
            }
        });
    });
    $('#album-modal-<?= $id ?>').on('hidden.bs.modal', function (e) {
        $('#album-modal-<?= $id ?>' + ' .loader').show();
        $('#album-modal-<?= $id ?>' + ' .album-content').html(null);
        $('#album-modal-<?= $id ?>' + ' .modal-footer').hide();
    });
</script>