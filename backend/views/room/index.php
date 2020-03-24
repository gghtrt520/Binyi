<?php

use yii\helpers\Html;
use backend\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Room'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\CheckboxColumn::className()],
            'id',
            [
                'attribute'=>'avatar_url',
                'format' => 'raw',
                'value' => function ($model){
                    return Html::img($model->avatar_url, ['height' => '30px','width'=>'30px']);
                }
    
            ],
            'surname',
            'name',
            'gender',
            'birthdate',
            'death',
            'age',
            'native',
            'religion',
            'relation',
            [
                'attribute' => 'rule',
                'options'   => ['style' => 'width:100px'],
                'format'    => 'html',
                'filter'    => [0=>'仅自己可见',1=>'公开权限'],
                'value'     => function ($item) {
                    if($item['rule']== 0) {
                        return '<span class="badge">仅自己可见</span>';
                    }else{
                        return '<span class="bg-green">公开权限</span>';
                    }
                }
            ],
            [
                'attribute' => 'is_show',
                'options'   => ['style' => 'width:60px'],
                'format'    => 'html',
                'filter'    => [0=>'未审核',1=>'审核'],
                'value'     => function ($item) {
                    if($item['is_show']== 0) {
                        return '<span class="badge">未审核</span>';
                    }else{
                        return '<span class="badge bg-green">审核</span>';
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
