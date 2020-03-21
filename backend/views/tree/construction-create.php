<?php

use yii\helpers\Html;

$this->title = '添加施工单位';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '施工单位', 'url' => ['construction-unit']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tree-category-create">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>

</div>
