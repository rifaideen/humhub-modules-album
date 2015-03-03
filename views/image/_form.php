<?php
/* @var $this ImageController */
/* @var $model AlbumImage */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('HActiveForm', [
	'id'=>'album-image-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>[
            'enctype'=>'multipart/form-data'
        ]
]); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
                <label>Image</label><br/>
                <?php 
                if ($model->isNewRecord):
                    $this->widget('application.modules.album.widgets.ImageUploadButtonWidget',[
                        'fileListFieldName' => 'AlbumImage[_image]',
                        'object' => $model,
                        'uploaderId' => 'image_uploader'
                    ]);
                    
                    $this->widget('application.modules_core.file.widgets.FileUploadListWidget',[
                        'uploaderId' => 'image_uploader'
                    ]); 
                endif;
                ?>
                
		<?php echo $form->error($model,'_image'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',['class'=>'form-control','maxlength'=>100]); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',['class'=>'form-control','maxlength'=>255]); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

        <hr>
        
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Add to Album' : 'Update Image Details',['class'=>'btn btn-primary']); ?>

<?php $this->endWidget(); ?>