<?php

$this->title = '添加树木入库';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => '树木统计', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-information-create">
    <?=$this->render('_form_create', ['model' => $model])?>
</div>
