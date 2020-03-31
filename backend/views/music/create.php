<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Music */

$this->title = Yii::t('app', 'Create Music');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Musics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="music-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
