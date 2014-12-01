<?php
/* @var $this AlbumController */
/* @var $model Album */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('HActiveForm', [
	'id'=>'album-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
]); ?>

	<p class="hint">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,null,null,['class'=>'errorMessage']); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',['maxlength'=>255,'class'=>'form-control']); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',['rows'=>6, 'cols'=>50,'class'=>'form-control']); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

        <div class="row">
                <label>Album Cover</label><br/>
                <?php 
                if ($model->isNewRecord):
                    $this->widget('application.modules.album.widgets.ImageUploadButtonWidget',[
                        'fileListFieldName' => 'cover',
                        'object' => $model,
                        'uploadTo' => '//album/image/upload',
                        'uploaderId' => 'cover_uploader'
                    ]); 
                
                    $this->widget('application.modules_core.file.widgets.FileUploadListWidget',[
                        'uploaderId' => 'cover_uploader'
                    ]); 
                endif;
                ?>
        </div>
        
	<div class="row">
		<?php echo CHtml::submitButton('Create Album',['class'=>'btn btn-primary']); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->