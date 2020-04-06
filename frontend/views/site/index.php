<?php

use frontend\assets\AppAsset;
/* @var $this yii\web\View */

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
                    <a href="#"><img src="/img/banner.png" alt=""></a>
                </li>
                <li class="case_2">
                    <a href="#"><img src="/img/banner.png" alt=""></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="mycontainer">
        <div style="height: 360px;"></div>
        <div>
            <div class="title-text">
                <h1></h1>
                <h2><i class="icon-back-img icon-size-40-50"></i>抗疫英雄<i class="icon-back-img icon-size-40-50"></i></h2>
            </div>
            <div class="list-nav">
                <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div class="title-text">
                <h1></h1>
                <h2><i class="icon-back-img icon-size-40-50"></i>时代人物<i class="icon-back-img icon-size-40-50"></i></h2>
            </div>
            <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/zyxt7.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        <div>
            <div class="title-text">
                <h1></h1>
                <h2><i class="icon-back-img icon-size-40-50"></i>艺术人生<i class="icon-back-img icon-size-40-50"></i></h2>
            </div>
            <div class="teacher-div">
                <ul class="teacher-ul cf">
                    <li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li><li class="f_l">
                        <div class="div-teacher-info">
                            <div class="img-div-teacher"><img src="/img/04.png" alt=""/></div>
                            <h6>杨袖珠</h6>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="bigBox">
    <div class="showBox"></div>
    <div class="dialog">
        <div class="title-dialog cf">
            <h6 class="f_l"><i class="icon-back-img2 icon-size-48-48 person-icon"></i>填写VIP卡信息登录</h6>
            <i class="f_r close-icon"></i>
        </div>
        <div class="content-dialog">
            <h5>VIP会员登录</h5>
            <div class="input-card"><span>卡号：</span><label for="6"><input type="text" id="6" placeholder="请输入您购买的VIP卡号"/></label></div>
            <div class="input-card"><span>密码：</span><label for="7"><input type="password" id="7" placeholder="请输入您的VIP卡密码"/></label></div>
            <div class="yzm-div-login"><div class="yzm-input"><span>验证码：</span><label for="8"><input type="text" id="8" placeholder="请输入图片验证码"/></label></div><a href="">
                <div class="yzm-div"><img src="" alt=""/></div><p>换一张</p></a></div>
            <p>注：您可以致电400-888-8888购买会员卡进入下一步操作！</p>
            <div class="btn-card-div">
                <button>确认</button>
                <p class="errorMsg">错误信息！</p>
            </div>
        </div>
    </div>
</div>