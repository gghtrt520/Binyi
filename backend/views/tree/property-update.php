<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
if (Yii::$app->request->get('action', '') == 'clone-tree-property-unit') {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['clone-tree-property-unit']];
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['property-view', 'id' => $model->id,'action'=>'clone-tree-property-unit']];
} else {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['tree-property-unit']];
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['property-view', 'id' => $model->id]];
}
$this->params['breadcrumbs'][] = '更新';
?>
<div class="tree-category-update">

    <?= $this->render('property_unit_form', [
        'model' => $model,
    ]) ?>

</div>

