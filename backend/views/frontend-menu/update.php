<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendMenu */

$this->title = Yii::t('app', 'Update Frontend Menu: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frontend Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="frontend-menu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
