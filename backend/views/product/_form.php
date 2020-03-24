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
            'defaultPreviewContent'=>'请上传贡品样式图片',
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择贡品样式图片',
            'allowedFileExtensions'=>['jpg','gif','png']
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
