<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FrontendMenu */

$this->title = Yii::t('app', 'Create Frontend Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frontend Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontend-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
