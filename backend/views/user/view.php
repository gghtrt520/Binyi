<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ConservationUnit;
use common\models\ConstructionUnit;
use common\models\PropertyUnit;

$this->title = $model->nick_name;
$this->params['breadcrumbs'][] = ['label' => '用户管理'];
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nick_name',
            [
                'attribute'=>'avatar_url',
                'label'    => '用户头像',
                'format' => 'raw',
                'value' => function ($model){
                    return Html::img(Yii::$app->homeUrl.$model->avatar_url, ['height' => '30px','width'=>'30px']);
                }
    
            ],
            [
                'attribute' => 'gender',
                'value' => function ($model) {
                    if ($model->gender == 0) {
                        return '保密';
                    }
                    if ($model->gender == 1) {
                        return '男';
                    }
                    if ($model->gender == 2) {
                        return '女';
                    }
                },
            ],
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    if ($model->type == 1) {
                        return '系统授权用户';
                    }
                    if ($model->type == 2) {
                        return '微信授权用户';
                    }
                },
            ],
            'email:email',
            [
                "attribute" => "created_at",
                "format" => ["date", "php:Y-m-d H:i:s"],
            ]
        ],
    ]) ?>
</div>
