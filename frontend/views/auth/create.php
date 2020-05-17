<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;

$this->title = '天堂纪念馆';
AppAsset::register($this);

AppAsset::addCss($this, "plugin/bootstrap/css/bootstrap.min.css");
AppAsset::addCss($this, "plugin/cropper/cropper.css");
AppAsset::addCss($this, "plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css");
AppAsset::addScript($this, "plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
AppAsset::addScript($this, "plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.zh-CN.js");
AppAsset::addScript($this, "plugin/cropper/cropper.js");
AppAsset::addScript($this, "plugin/cropper/jquery-cropper.js");

AppAsset::addCss($this, "css/create.css");
AppAsset::addScript($this, "js/create.js");
?>
<div class="main mycontainer">
    <div>
        <div class="form-content">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="username" class="col-sm-4 control-label">头像：</label>
          <div class="col-sm-8 avator">
            <img src="/img/tp1.png">
            <input type="hidden" name="avator">
          </div>
        </div>
        <div class="form-group">
          <label for="username" class="col-sm-4 control-label">逝者姓名：</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="username" placeholder="请输入逝者姓名">
          </div>
        </div>
        <div class="form-group">
          <label for="sex" class="col-sm-4 control-label">性别：</label>
          <div class="col-sm-8">
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" id="inlineRadio1" checked value="男"> 男
            </label>
            <label class="radio-inline">
              <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="女"> 女
            </label>
          </div>
        </div>
        <p style="text-align: right;color: red;">注：以上信息无法修改</p>
        <div class="form-group">
          <label for="jiyu" class="col-sm-4 control-label">寄语：</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="jiyu" placeholder="请输入寄语">
          </div>
        </div>
        <div class="form-group">
          <label for="jiyu" class="col-sm-4 control-label">生辰：</label>
          <div class="col-sm-8">
            <div class="input-group date start-time col-md-12">
              <input class="form-control" size="16" type="text" value="" readonly>
             <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>  
          </div>
        </div> 
        <div class="form-group">
          <label for="jiyu" class="col-sm-4 control-label">忌日：</label>
          <div class="col-sm-8">
            <div class="input-group date end-time col-md-12">
              <input class="form-control" size="16" type="text" value="" readonly>
             <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>  
          </div>
        </div>
        <div class="form-group">
          <label for="age" class="col-sm-4 control-label">享年：</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" readonly id="age" placeholder="未知"> 
          </div>
        </div>
        <div class="form-group">
          <label for="age" class="col-sm-4 control-label">籍贯：</label>
          <div class="col-sm-8 select-v">
            <input type="text" placeholder="省" id="province">
            <input type="text" placeholder="市" id="city">
            <input type="text" placeholder="区/县" id="area">
            <!-- <select class="form-control">
              <option value="1">陕西省</option>
            </select>
            <select class="form-control">
              <option value="1">西安市</option>
              <option value="2">延安市</option>
            </select>
            <select class="form-control">
              <option value="2">碑林区</option>
              <option value="1">未央区</option>
            </select> -->
          </div>
        </div>
        <div class="form-group">
          <label for="age" class="col-sm-4 control-label">权限：</label>
          <div class="col-sm-8">
            <select class="form-control rule">
              <option value="0">仅自己可见</option>
              <option value="1">公开</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="button" class="btn btn-default cancel">取消</button>
            <button type="button" class="btn btn-primary save">保存</button>
          </div>
        </div>
      </form>
    </div>
    </div>
</div>
<div class="dialog-wrap">
    <div id="dialog">
        <div class="preview">
            <img id="preview" />
        </div>
        <div style="text-align: center;">
            <div class="box">
            <button class="btn btn-primary selectImg">选择图片</button>
            <input id="imgPicker" type="file" accept="image/" />
            </div>
        </div>
        <div class="footer-dialog">
            <button class="celBtn btn btn-default">取消</button>
            <button class="comBtn btn btn-primary">确定</button>
        </div>
    </div>
</div>