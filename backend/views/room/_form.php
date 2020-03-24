<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'avatar_url')->widget(FileInput::classname(), [
        'options' => ['multiple' => false,'accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择树木照片',
            'allowedFileExtensions'=>['jpg','gif','png']
        ]
    ]);?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ '男' => '男', '女' => '女', ], ['prompt' => '请选择性别']) ?>

    <?= $form->field($model, 'birthdate')->textInput() ?>

    <?= $form->field($model, 'death')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'native')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rule')->dropDownList([ '0' => '公开', '1' => '仅自己可见', ], ['prompt' => '请选择浏览权限']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
