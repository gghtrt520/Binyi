<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pay */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pay-view">


    <p>
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
            [
                'attribute' => 'type',
                'value'     => function ($model) {
                    if($model->type == 1){
                        return '房间';
                    }elseif ($model->type == 2) {
                        return '背景主题';
                    }elseif ($model->type == 3) {
                        return '祭品';
                    }else {
                        return '--';
                    }
                }
            ],
            'pay_num',
            [
                'attribute' => 'user.nick_name',
                'label'     =>'付费用户',
                'value'     =>function ($model) {
                    return $model->user->nick_name;
                }
            ],
            [
                'attribute' => 'type_id',
                'value'     => function ($model) {
                    return $model->payProduct ? $model->payProduct->name :'已删除';
                }
            ],
            'created_at',
        ],
    ]) ?>

</div>
