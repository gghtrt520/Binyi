<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
            'id',
            [
                'attribute'=>'avatar_url',
                'format' => 'raw',
                'value' => function ($model){
                    return Html::img(Yii::$app->homeUrl.$model->avatar_url, ['height' => '30px','width'=>'30px']);
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
            'rule',
            'is_show',
            'updated_at',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
