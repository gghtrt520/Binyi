<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '种类管理';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<p>
    <?=Html::a('添加树木种类', ['category-create'], ['class' => 'btn btn-success'])?>
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
        'category',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'contentOptions' => [
                'class' => 'text-center',
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='category-view?id='.$model->id;
                    return $url;
                }
                if ($action === 'update') {
                    $url = 'category-update?id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='category-delete?id='.$model->id;
                    return $url;
                }
            }
        ]
    ],
]);
?>
<?php Pjax::end(); ?>
