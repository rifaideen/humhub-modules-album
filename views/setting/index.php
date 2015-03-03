<?php
/* @var $this AlbumController */
/* @var $model AlbumSettings */
/* @var $form HActiveForm */
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->widget('application.modules_core.admin.widgets.AdminMenuWidget', array()); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Album</strong> settings</div>
                <div class="panel-body">
                    <?php
                    $form = $this->beginWidget('HActiveForm', [
                        'id' => 'album-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                    ]);
                    ?>

                        <?php echo $form->errorSummary($model, null, null, ['class' => 'errorMessage']); ?>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'allowedExtensions'); ?>
                            <?php echo $form->textField($model, 'allowedExtensions', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'allowedExtensions'); ?>
                            <p class="help-block">Comma separated list. use valid image extensions.</p>
                        </div>

                        <hr>
                        
                        <?php echo CHtml::submitButton('Save', ['class' => 'btn btn-primary']); ?>
                        <!-- show flash message after saving -->
                        <?php $this->widget('application.widgets.DataSavedWidget'); ?>
                        

                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>