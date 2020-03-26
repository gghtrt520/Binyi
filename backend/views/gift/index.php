<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\GiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gifts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gift-index">



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'room',
                'value' => 'room.name',
                'label' => '纪念馆名称',
            ],
            [
                'attribute' => 'product',
                'value' => 'product.name',
                'label' => '贡品名称',
            ],
            [
                'attribute' => 'user',
                'value' => 'user.nick_name',
                'label' => '赠送用户',
            ],
            'created_at',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
