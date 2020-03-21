<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '施工单位', 'url' => ['construction-unit']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="tree-category-view">
    <p>
        <?= Html::a('更新', ['construction-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['construction-delete', 'id' => $model->id], [
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
            'created_at',
        ],
    ]) ?>

</div>

