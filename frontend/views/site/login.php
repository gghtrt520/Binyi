<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<div class="site-login">


    <div class="row">
        <div id="login_container">
        </div>
    </div>
</div>
<script>
    var obj = new WxLogin({
        self_redirect:false,
        id:"login_container", 
        appid: '<?= Html::encode(Yii::$app->params['AppID'])?>', 
        scope: "snsapi_login", 
        redirect_uri: "<?= Html::encode(urlencode(Yii::$app->request->hostInfo.'/site/index'))?>",
        state: "",
        style: "",
        href: ""
    });
</script>
