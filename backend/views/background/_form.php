<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

?>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'background')->widget(FileInput::classname(), [
        'options' => ['multiple' => false,'accept' => 'image/*'],
        'pluginOptions' => [
            'autoReplace'=>true,
            'initialPreviewShowDelete'=>false,
            'defaultPreviewContent'=>'请上传祭祀背景样式图片',
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请上传祭祀背景样式图片',
            'allowedFileExtensions'=>['jpg','gif','png'],
            'initialPreviewAsData'=>true,
            'initialPreview'=>[
                $model->background
            ],
        ]
    ]);?>

    <?= $form->field($model, 'price')->textInput(['placeholder'=>"价格为0表示祭祀背景免费,默认为0"]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
