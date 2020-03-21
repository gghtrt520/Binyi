<?php

use yii\helpers\Html;

$this->title = '更新: ' . $model->nick_name;
$this->params['breadcrumbs'][] = ['label' => '用户管理'];
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nick_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>

<div class="user-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>