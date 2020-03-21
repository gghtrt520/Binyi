<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '养护单位', 'url' => ['conservation-unit']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['conservation-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="tree-category-update">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>
</div>
