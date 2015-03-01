<?php
/* @var $this UpdateController */
/* @var $model Album */
/* @var $form CActiveForm */
?>

<h1>Update Album Cover</h1>


<div class="form">

<?php $form=$this->beginWidget('HActiveForm', [
	'id'=>'album-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
]); ?>

	<p class="hint">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,null,null,['class'=>'errorMessage']); ?>

	
        <div class="row">
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
        
        <div class="row">
            <?php echo CHtml::submitButton('Update Cover',['class'=>'btn btn-primary']); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->