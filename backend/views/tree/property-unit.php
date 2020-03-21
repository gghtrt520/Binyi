<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '产权单位';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<p>
    <?=Html::a('添加产权单位', ['property-create'], ['class' => 'btn btn-success'])?>
</p>
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $data,
    'formatter'    => ['class' => 'yii\i18n\Formatter','nullDisplay' => '--'],
    "rowOptions" =>[
        'class' => 'text-center',
    ],
    'columns' => [
        'name',
        'provinceName.province_name',
        'cityName.city_name',
        'areaName.area_name',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='property-view?id='.$model->id;
                    return $url;
                }
                if ($action === 'update') {
                    $url = 'property-update?id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='property-delete?id='.$model->id;
                    return $url;
                }
            }
        ]
    ],
]);
?>
<?php Pjax::end(); ?>
