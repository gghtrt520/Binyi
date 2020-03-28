<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Combination */

$this->title = Yii::t('app', 'Update Combination: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Combinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="combination-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
