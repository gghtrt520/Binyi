<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
if (Yii::$app->request->get('action', '') == 'clone-tree-property-unit') {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['clone-tree-property-unit']];
} else {
    $this->params['breadcrumbs'][] = ['label' => '产权单位', 'url' => ['tree-property-unit']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="tree-category-view">
    <p>
        <?php if (Yii::$app->request->get('action', '') == 'clone-tree-property-unit') : ?>
            <?= Html::a('更新', ['property-update', 'id' => $model->id,'action'=>'clone-tree-property-unit'], ['class' => 'btn btn-primary']) ?>
        <?php else : ?>
            <?= Html::a('更新', ['property-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        <?= Html::a('删除', ['property-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'provinceName.province_name',
            'cityName.city_name',
            'areaName.area_name',
            'created_at',
        ],
    ]) ?>

</div>
