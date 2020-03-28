<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Combination */

$this->title = Yii::t('app', 'Create Combination');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Combinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combination-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
