<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use  yii\helpers\Url;

$this->title = '云典殿堂';
AppAsset::register($this);
AppAsset::addCss($this, "css/my.css");
AppAsset::addScript($this, "js/my.js");
?>
<div class="main mycontainer">
    <div class="page-title cf">
        <h2 class="f_l"><i class="icon-back-img2 icon-size-40-50 icon-school-page"></i>我的纪念馆</h2>
        <a href="/auth/create" class="creatBtn">创建纪念馆</a>
    </div>
    <?php if ($room): ?>
        <div class="list-v">
            <ul class="teacher-ul cf">
            <?php foreach ($room as $value) : ?>
                <li class="f_l">
                    <div class="div-teacher-info">
                        <div class="img-div-teacher"><a href="<?=Url::toRoute(['site/about','id' =>$value->id]);?>"><img src="<?= Html::encode($value->avatar_url) ?>" alt=""></a></div>
                        <h6><?= Html::encode($value->name) ?></h6>
                    </div>
                </li>
            <?php endforeach ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="nodata">
            暂无信息
        </div>
    <?php endif ?>
</div>