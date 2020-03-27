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
            'autoReplace'=>true,
            'initialPreviewShowDelete'=>false,
            'defaultPreviewContent'=>'请上传头像图片',
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择头像照片',
            'allowedFileExtensions'=>['jpg','gif','png'],
            'initialPreviewAsData'=>true,
            'initialPreview'=>[
                $model->avatar_url
            ],
        ]
    ]);?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ '男' => '男', '女' => '女', ], ['prompt' => '请选择性别']) ?>

    <?= $form->field($model, 'birthdate')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => '请选取生辰时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd',
            ]
    ]);?>

    <?= $form->field($model, 'death')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => '请选取忌日时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd',
            ]
    ]);?>


    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList(Yii::$app->params['Category'], ['prompt' => '请选择分类']) ?>

    <?= $form->field($model, 'background_id')->dropDownList(\common\models\Background::getList(), ['prompt' => '默认背景图片']) ?>

    <?= $form->field($model, 'is_pay')->dropDownList([ '0' => '免费', '1' => '付费'], ['prompt' => '请选择房间类型']) ?>

    <?= $form->field($model, 'rule')->dropDownList([ '0' => '公开', '1' => '仅自己可见'], ['prompt' => '请选择浏览权限']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
