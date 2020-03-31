<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Music */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url')->widget(FileInput::classname(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload'=>false,
            'defaultPreviewContent'=>'请上传背景音乐',
            'previewFileType' => 'any',
            'initialPreviewAsData'=>true,
            'initialCaption'=>$model->name,
            'initialPreviewShowDelete'=>false,
            'browseLabel'=>'请上传背景音乐',
            'allowedFileExtensions'=>['mp3','wma','aac'],
            'initialPreview'=>[
                $model->video_url
            ],
            'initialPreviewConfig'=>[
                'caption'=>$model->video_url,
                'key'=>$model->id
            ]
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
