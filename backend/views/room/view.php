<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="room-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'avatar_url:url',
            'name',
            'gender',
            'birthdate',
            'death',
            'age',
            'description',
            [
                'label' => '籍贯',
                'options'   => ['style' => 'width:150px'],
                'value'     => function ($model) {
                    return $model->province.$model->city.$model->area;
                }
            ],
            'religion',
            [
                'attribute' => 'rule',
                'value'     => function ($model) {
                    if($model['rule']== 0) {
                        return '仅自己可见';
                    }else{
                        return '公开权限';
                    }
                }
            ],
            'updated_at',
            'created_at',
        ],
    ]) ?>

</div>
