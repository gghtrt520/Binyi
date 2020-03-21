<?php

use yii\helpers\Html;

$this->title = '添加产权单位';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
if (Yii::$app->request->get('action', '') == 'clone-tree-property-unit') {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['clone-tree-property-unit']];
} else {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['tree-property-unit']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-category-create">
    <?= $this->render('property_unit_form', [
        'model' => $model,
    ]) ?>

</div>


