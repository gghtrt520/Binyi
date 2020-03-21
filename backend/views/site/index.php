<?php

$this->title = '纪念馆后台管理系统';

use kartik\tree\TreeView;
use common\models\UnitCategory;
use kartik\tree\Module;
use yii\helpers\Url;
use common\models\User;
use common\models\TreeInformation;
use yii\helpers\Html;
?>

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">系统用户</span>
        <span class="info-box-number"><?= Html::encode(User::find()->count()) ?>位</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>