<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pays');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'type',
                'filter'    => [1=>'房间',2=>'背景主题',3=>'祭品'],
                'value'     => function ($model) {
                    if($model->type == 1){
                        return '房间';
                    }elseif ($model->type == 2) {
                        return '背景主题';
                    }elseif ($model->type == 3) {
                        return '祭品';
                    }else {
                        return '不存在';
                    }
                }
            ],
            'pay_num',
            [
                'attribute' => 'username',
                'label'     =>'付费用户',
                'value'     =>'user.nick_name' 
            ],
            [
                'attribute' => 'type_id',
                'filter'=>false,
                'value'     => function ($model) {
                    return $model->payProduct ? $model->payProduct->name :'已删除';
                }
            ],
            [
            'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
