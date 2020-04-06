<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="header">
    <div class="container header-top cf">
        <div class="f_l">
            <p><span class="title-head">云典祭祀</span><i class="icon-back-img icon-size-40-36 tel-icon-pos"></i> : 029-84851765
            </p>
        </div>
        <div class="f_r">
            <ul class="header-top-nav">
                <li><a href="">小程序</a></li><li style="border-right: none;"><a href="javascript:showLoginBox();"><i class="icon-back-img icon-size-40-36 micChat-icon-pos"></i>登录注册</a></li><li style="border-right: none;"><a href="">我的纪念馆</a></li>
            </ul>
        </div>
    </div>
    <!-- <div class="header-bottom">
        <div class="container header-bottom-content cf">
            <div class="logo-img-div f_l"><a href="index.html"><img src="/img/zygjsy.png" alt=""/></a></div>
            <div class="f_r">
                <ul class="header-bottom-nav">
                    <li><a class="active-li-nav" href="index.html">首页</a></li>
                </ul>
            </div>
        </div>
    </div> -->
</div>

<div>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<br><br>
<div class="footer">
    <div class="footer-content container cf">
        <div class="f_l footer-tel-div">
            <p>服务邮箱:</p>
            <h6>7064755@qq.com</h6>
        </div>
        <div class="f_r">
            <div class="footer-img-div"><img src="/img/07.png" alt="二维码"/></div>
            <div class="footer-right-text">
                <ul class="footer-nav">
                    <li><a href="">关于我们</a></li>
                    <li style="padding-right: 0;border-right: none;"><a href="">帮助中心</a></li>
                </ul>
                <p>2020-2026 版权所有，翻版必究</p>
                <p>微信号: <span>测试</span></p>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
