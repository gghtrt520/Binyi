<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'style')->widget(FileInput::classname(), [
        'options' => ['multiple' => false,'accept' => 'image/*'],
        'pluginOptions' => [
            'showUpload'=>false,
            'defaultPreviewContent'=>'请上传贡品样式图片',
            'previewFileType' => 'any',
            'initialPreviewAsData'=>true,
            'initialCaption'=>$model->style,
            'initialPreviewShowDelete'=>false,
            'browseLabel'=>'请选择贡品样式图片',
            'allowedFileExtensions'=>['jpg','gif','png'],
            'initialPreview'=>[
                $model->style
            ],
            'initialPreviewConfig'=>[
                'caption'=>$model->style,
                'key'=>$model->id
            ]
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
