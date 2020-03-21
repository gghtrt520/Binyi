<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="tree-information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tree_number') ?>

    <?= $form->field($model, 'tree_image') ?>

    <?= $form->field($model, 'latitude') ?>

    <?= $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'nation') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'tree_category_id') ?>

    <?php // echo $form->field($model, 'property_unit_id') ?>

    <?php // echo $form->field($model, 'construction_unit_id') ?>

    <?php // echo $form->field($model, 'conservation_unit_id') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
