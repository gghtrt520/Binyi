<?php

use yii\helpers\Html;

$this->title = '添加树木种类';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '种类管理', 'url' => ['tree-category']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-category-create">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>
</div>

