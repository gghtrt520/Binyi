<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '种类管理', 'url' => ['tree-category']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['category-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="tree-category-update">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>

</div>
