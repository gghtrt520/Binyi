<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\PropertyUnit;

$this->title = '树木统计';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<p>
    <?php if (Yii::$app->user->identity->userAssign->is_write == '可录入'): ?>
        <?=Html::a('添加树木入库', ['create'], ['class' => 'btn btn-success'])?>
    <?php endif ?>
    <?=Html::a('导出树木信息', ['export'], ['class' => 'btn btn-success pull-right'])?>
</p>
<?php Pjax::begin();?>
<?=GridView::widget([
    'dataProvider' => $data,
    'filterModel' => $search,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '--'],
    "rowOptions" => [
        'class' => 'text-center',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'tree_number',
        [
            'label'  =>'照片',
            "format" => [
                "image",
                [
                    "width"=>"30",
                    "height"=>"30"
                ]
            ],
            'value' => function ($model) {
                return $model->treeImage?$model->treeImage->tree_image:'';
            },
        ],
        'province',
        'city',
        'district',
        [
            'attribute' => 'tree_category_name',
            'value' => 'treeCategory.name',
            'label' => '树种分类',
        ],
        [
            'attribute' => 'conservation_unit_name',
            'value' => 'conservationUnit.name',
            'label' => '养护单位',
        ],
        [
            'attribute' => 'construction_unit_name',
            'value' => 'constructionUnit.name',
            'label' => '施工单位',
        ],
        [
            'attribute' => 'property_unit_name',
            'value' => 'propertyUnit.name',
            'label' => '产权单位',
        ],
        [
            'attribute' => 'parent_unit',
            'value' => function ($model) {
                if ($model->propertyUnit->parent_id == 0) {
                    return '';
                } else {
                    return PropertyUnit::findOne($model->propertyUnit->parent_id) ?PropertyUnit::findOne($model->propertyUnit->parent_id)->name :'';
                }
            },
            'label' => '父级单位',
        ],
        [
            'attribute' => 'created_at',
            'value' => 'created_at',
            'label' => '创建时间',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
        ],
    ],
]);
?>
<?php Pjax::end();?>
