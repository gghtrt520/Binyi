<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Musics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="music-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Music'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'video_url',
                'format'=>'raw',
                'value' => function ($model){
                    return Html::a($model->video_url,$model->video_url,['target'=>'_blank']);
                }
    
            ],
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
