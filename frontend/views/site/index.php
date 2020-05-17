<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use  yii\helpers\Url;

$this->title = '天堂纪念馆';
AppAsset::register($this);
AppAsset::addCss($this, "css/index.css");
AppAsset::addScript($this, "js/script.js");
AppAsset::addScript($this, "js/index.js");
?>
<!--页面头部-->
<div class="main">
    <div class="case">
        <div id="slider" class="case_box">
            <ul>
                <li class="case_1">
                    <a href="#"><img src="/img/banner1.jpg" alt=""></a>
                </li>
                <li class="case_2">
                    <a href="#"><img src="/img/banner2.jpg" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mycontainer">
        <div style="height: 360px;"></div>
        <div>
            <!-- <div class="title-text">
                <h1></h1>
                <h2><i></i>抗疫英雄<i></i></h2>
            </div>
            <div class="list-nav">
                <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""/></a></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""/></a></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""/></a></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""/></a></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""/></a></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                </ul>
            </div> -->
        </div>
        <div>
            <div class="title-text">
                <h1></h1>
                <h2><i></i>时代人物<i></i></h2>
            </div>
            <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <?php if ($era) : ?>
                        <?php foreach ($era as $value) : ?>
                            <li class="f_l">
                                <div class="div-teacher-info">
                                    <div class="img-div-teacher"><a href="<?=Url::toRoute(['site/about','id' =>$value->id]);?>"><img src="<?= Html::encode($value->avatar_url) ?>" alt=""/></a></div>
                                    <h6><?= Html::encode($value->name) ?></h6>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        </div>
        <div>
            <div class="title-text">
                <h1></h1>
                <h2><i></i>艺术人生<i></i></h2>
            </div>
            <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <?php if ($per) : ?>
                        <?php foreach ($per as $value) : ?>
                            <li class="f_l">
                                <div class="div-teacher-info">
                                    <div class="img-div-teacher"><a href="<?=Url::toRoute(['site/about','id' =>$value->id]);?>"><img src="<?= Html::encode($value->avatar_url) ?>" alt=""/></a></div>
                                    <h6><?= Html::encode($value->name) ?></h6>
                                </div>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="bigBox">
    <div class="showBox"></div>
    <div class="dialog-login">
        <div class="title-dialog cf">
            <h6 class="f_l"><i class="icon-back-img2 icon-size-48-48 person-icon"></i>微信扫码登录</h6>
            <i class="f_r close-icon"></i>
        </div>
        <div class="content-dialog">
            <h5>请使用微信扫码</h5>
            <div>
                <img src="/img/07.png">
            </div>
        </div>
    </div>
</div>