<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->tree_number;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '树木统计', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<div class="tree-information-update">
    <?= $this->render('_form_update', [
        'model' => $model,
        'image' => $image,
        'id'    => $id
    ]) ?>
</div>
