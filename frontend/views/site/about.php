<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<style type="text/css">
    .left-base{
        display: inline-block;
        width: 350px;
        height: 500px;
        padding: 5px;
        border: 1px solid #ddd;
        margin-right: 30px;
    }
    .right-bgimg{
        display: inline-block;
        width: 800px;
        height: 510px;
        overflow: hidden;
        float: right;
    }
    .base-title{
        padding: 10px;
	    font-size: 20px;
	    font-weight: bold;
	    border-bottom: 1px solid #ddd;
    }
    .content-p > p{
        margin: 16px 12px;
        font-size: 14px;
        line-height: 1.5;
        word-break: break-all;
    }
    .content-p > p span{
        color: #999;
    }
    .content-right{
        width: 284px;
        height: 100%;
        margin: 0 auto;
    }
    .big-bg{
        position: relative;
        width: 100%;
        height: 100%;
        background-position: center;
        background-size: cover;
    }
    .avator-bg{
        width: 80px;
        height: 96px;
        background-position: center;
        background-size: cover;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -40px;
        margin-top: -48px;
    }
</style>
<div class="main mycontainer cf">
    <br><br>
    <div class="left-base">
        <h2 class="base-title">基本信息</h2> 
        <div class="content-p">
            <p>姓名： <span><?= Html::encode($room->name) ?></span></p>
            <p>性别： <span><?= Html::encode($room->gender) ?></span></p>
            <p>生辰： <span><?= Html::encode($room->birthdate) ?></span></p>
            <p>忌日： <span><?= Html::encode($room->death) ?></span></p>
            <p>享年： <span><?= Html::encode($room->age) ?></span></p>
            <p>籍贯： <span><?= Html::encode($room->province.$room->city.$room->area) ?></span></p>
            <p>寄语： <span><?= Html::encode($room->description) ?></span></p>
        </div>  
    </div>
    <div class="right-bgimg">
        <div class="content-right">
            <div class="big-bg" style="background-image: url(<?= Html::encode($room->background?$room->background->background:'https://xcx.xhbinyi.com/upload/bg1111111.jpg') ?>);">
                <div class="avator-bg" style="background-image: url(<?= Html::encode($room->avatar_url) ?>);"></div>
            </div>
        </div>
    </div>
</div>
