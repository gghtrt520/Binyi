<?php

use yii\helpers\Html;

$this->title = '添加系统用户';
$this->params['breadcrumbs'][] = ['label' => '用户管理'];
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
