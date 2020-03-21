<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '树木统计', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="tree-information-view">
    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tree_name',
            'tree_number',
            'diameter',
            'crown',
            'height',
            'health',
            'latitude',
            'longitude',
            'nation',
            'province',
            'city',
            'district',
            'street',
            'treeCategory.name',
            'propertyUnit.name',
            'constructionUnit.name',
            'conservationUnit.name',
            'other',
        ],
    ]) ?>
</div>
