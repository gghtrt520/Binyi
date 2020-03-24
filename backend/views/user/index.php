<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '用户列表';
$this->params['breadcrumbs'][] = ['label' => '用户管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<!-- <p>
    <?=Html::a('添加系统用户', ['create'], ['class' => 'btn btn-success'])?>
</p> -->
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $data,
    'formatter'    => ['class' => 'yii\i18n\Formatter','nullDisplay' => '--'],
    "rowOptions" =>[
        'class' => 'text-center',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute'=>'nick_name',
            'label'    => '用户名',
            'value'    => 'nick_name'

        ],
        [
            'attribute'=>'avatar_url',
            'label'    => '用户头像',
            'format' => 'raw',
            'value' => function ($model){
                return Html::img($model->avatar_url, ['height' => '30px','width'=>'30px']);
            }

        ],
        [
            'attribute'=>'gender',
            'label'=>'性别',
            'value' => function ($model) {
                return ['0'=>'保密','1'=>'男','2'=>'女'][$model->gender];
            }

        ],
        [
            'attribute'=>'type',
            'label'=>'用户类型',
            'value' => function ($model) {
                return ['1'=>'系统授权用户','2'=>'微信授权用户'][$model->type];
            }

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'操作',
            'template'=> '{view}',
        ],
    ],
]);
?>
<?php Pjax::end(); ?>




