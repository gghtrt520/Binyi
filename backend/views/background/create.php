<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Background */

$this->title = Yii::t('app', 'Create Background');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backgrounds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
