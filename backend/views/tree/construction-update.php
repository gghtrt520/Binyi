<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '施工单位', 'url' => ['construction-unit']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['construction-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="tree-category-update">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>
</div>
