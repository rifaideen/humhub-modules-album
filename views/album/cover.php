<?php
/* @var $this UpdateController */
/* @var $model Album */
/* @var $form CActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading">Update Album <strong>Cover</strong></div>
    <div class="panel-body">
        <?php $form=$this->beginWidget('HActiveForm', [
                'id'=>'album-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation'=>true,
        ]); ?>
        
            <?php echo $form->errorSummary($model,null,null,['class'=>'errorMessage']); ?>


            <div class="form-group">
                <label>Album Cover</label><br/>
                <?php 
                    $this->widget('application.modules.album.widgets.ImageUploadButtonWidget',[
                        'fileListFieldName' => 'Album[image]',
                        'object' => new Album,
                        'uploaderId' => 'cover_uploader'
                    ]); 

                    $this->widget('application.modules_core.file.widgets.FileUploadListWidget',[
                        'uploaderId' => 'cover_uploader'
                    ]);
                ?>
                <?php echo $form->error($model,'image'); ?>
            </div>

            <hr>

            <?php echo CHtml::submitButton('Update Cover',['class'=>'btn btn-primary']); ?>
            <?php echo CHtml::link('Back to Album', $this->createUrl('/album/details',['id'=>$model->id,'username'=>$user->username,'uguid'=>$user->guid]), ['class'=>'btn btn-info']); ?>

        <?php $this->endWidget(); ?>
    </div>
</div>