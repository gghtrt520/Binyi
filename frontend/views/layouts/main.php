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
            <p><span class="title-head">云典祭祀</span> 云端追思，文明祭祀
            </p>
        </div>
        <div class="f_r">
            <ul class="header-top-nav">
                <li><a href="/">首页</a></li>
                <li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="https://open.weixin.qq.com/connect/qrconnect?appid=wx07a5baa6f39cd947&redirect_uri=https://xcx.xhbinyi.com/site/wxcallback&response_type=code&scope=snsapi_login&state=STATE">登录注册</a>
                    <?php else: ?>
                        <a href="#"><?= Html::encode(Yii::$app->user->identity->nick_name) ?></a>
                    <?php endif ?>
                </li>
                <li><a href="/auth/myself">我的纪念馆</a></li><li style="border-right: none;"><a class="hover-show">小程序</a><div class="qr-v"><img src="/img/smallqr.jpg"></div></li>
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

<div style="padding-bottom: 40px;min-height: 700px;">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<div class="footer">
    <div class="footer-content container cf">
        <div class="f_l footer-tel-div">
            <p>联系电话:</p>
            <h6>029-84851765</h6>
            <p>服务邮箱:</p>
            <h6>7064755@qq.com</h6>
        </div>
        <div class="f_r">
            <div class="footer-img-div"><img src="/img/07.png" alt="二维码"/></div>
            <div class="footer-right-text">
                <ul class="footer-nav">
                    <li><a href="http://www.xhbinyi.com/site/ourserver">服务项目</a></li>
                    <li style="padding-right: 0;border-right: none;"><a href="http://www.xhbinyi.com/site/contact">联系我们</a></li>
                </ul>
                <p>2020-2021 版权所有，翻版必究</p>
                <p>公众号: <span>西户殡仪馆</span></p>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
