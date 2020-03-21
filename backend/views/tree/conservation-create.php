<?php

use yii\helpers\Html;

$this->title = '添加养护单位';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '养护单位', 'url' => ['conservation-unit']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-category-create">
    <?= $this->render('category_form', [
        'model' => $model,
    ]) ?>
</div>
