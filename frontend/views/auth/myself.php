<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;

$this->title = '天堂纪念馆';
AppAsset::register($this);
AppAsset::addCss($this, "css/my.css");
AppAsset::addScript($this, "js/my.js");
?>
<div class="main mycontainer">
    <div class="page-title cf">
        <h2 class="f_l"><i class="icon-back-img2 icon-size-40-50 icon-school-page"></i>我的纪念馆</h2>
        <button class="creatBtn">创建纪念馆</button>
    </div>
    <div class="list-v">
        <ul class="teacher-ul cf">
            <li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""></a></div>
                    <h6>杨袖珠</h6>
                </div>
            </li><li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""></a></div>
                    <h6>杨袖珠</h6>
                </div>
            </li><li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""></a></div>
                    <h6>杨袖珠</h6>
                </div>
            </li><li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><a href=""><img src="/img/04.png" alt=""></a></div>
                    <h6>杨袖珠</h6>
                </div>
            </li>
            <li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><img src="/img/zyxt7.png" alt=""></div>
                    <h6>杨袖珠</h6>
                </div>
            </li>
            <li class="f_l">
                <div class="div-teacher-info">
                    <div class="img-div-teacher"><img src="/img/zyxt7.png" alt=""></div>
                    <h6>杨袖珠</h6>
                </div>
            </li>
        </ul>
    </div>
    <!-- <div class="nodata">
        暂无信息
    </div> -->
</div>