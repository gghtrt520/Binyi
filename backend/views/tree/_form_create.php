<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\TreeCategory;
use common\models\ConservationUnit;
use common\models\ConstructionUnit;
use common\models\PropertyUnit;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
use kartik\file\FileInput;

?>
<link rel="stylesheet" type="text/css" href="/js/plugins/dropzone/basic.css">
<link rel="stylesheet" type="text/css" href="/js/plugins/dropzone/dropzone.css">
<script type="text/javascript" src="/js/plugins/dropzone/dropzone.js"></script>
<style type="text/css">
    #container{
        width:100%;
        height:400px;
   }
   .tree-information-form{
        width: 60%;
        margin: 0 auto;
   }
   .myId{
        position: relative;
        min-height: 100px;
        border: 1px dashed #ddd;
   }
   .myId img{
        width: 100%;
   }
   .dropzone-tip{
        position: absolute;
        width: 34%;
        top: 36%;
        left: 30%;
        text-align: center;
        font-size: 24px;
   }
</style>
<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=PHDBZ-CPACF-TIRJY-J4UTB-J67TQ-F6BBV"></script>
<script>
    // 切换图片区域
    function toggle(bool){
        var elArr = document.querySelectorAll('div.myId');
        if(bool){
            // 更新显示树木图片
            elArr[0].style.display = 'none';
            elArr[1].style.display = 'block';
        } else {
            // 添加显示树木上传
            elArr[1].style.display = 'none';
            elArr[0].style.display = 'block';
            document.getElementById('treeinformation-tree_image').value = '';
            var url = document.getElementById('treeinformation-tree_image').value;
            url = '/upload/' + url.split('/upload/')[1];
            delImg(url);
        }
    }
    // 删除图片
    function delImg(url){
        $.ajax({
            url: '/tree/delete-image',
            type: 'post',
            data: {path:url},
            success:function(res){
                if(res.status){
                    document.getElementById('treeinformation-tree_image').value = '';
                    document.querySelector('.dropzone-tip').style.display = 'block';
                } else {

                }
                
            }
        });
    }
 window.onload = function(){
    var map, marker, geocoder;
    /**
     * 经纬度信息回填
     * @Author   少侠
     * @DateTime 2019-06-20
     * @param    {[type]}   latLng [经纬度]
     */
    function setMarkerData(latLng){
        geocoder = new qq.maps.Geocoder();
        //设置服务请求成功的回调函数
        geocoder.setComplete(function(result) {
            map.setCenter(result.detail.location);
            console.log(result)
            document.getElementById('treeinformation-latitude').value = latLng.lat;
            document.getElementById('treeinformation-longitude').value = latLng.lng;
            document.getElementById('treeinformation-nation').value = result.detail.addressComponents.country;
            document.getElementById('treeinformation-province').value = result.detail.addressComponents.province;
            document.getElementById('treeinformation-city').value = result.detail.addressComponents.city;
            document.getElementById('treeinformation-district').value = result.detail.addressComponents.district;
            document.getElementById('treeinformation-street').value = result.detail.addressComponents.street;
        });
        //若服务请求失败，则运行以下函数
        geocoder.setError(function() {
            console.log("出错了，请输入正确的经纬度！！！");
        });
        geocoder.getAddress(latLng);
    }
    // 树木图片上传
    /*var myDropzone = new Dropzone("div#myId", { 
        url: "/tree/upload",
        paramName: 'image', 
        maxFiles: 1,
        clickable: true,
        acceptedFiles: 'image/*',
        previewsContainer: ".dropzone-previews",
        previewTemplate: document.querySelector('.dropzone-previews').innerHTML
    });
    myDropzone.on("addedfile", function(file) {
        console.log(file)
        document.querySelector('.dropzone-tip').style.display = 'none';
        document.querySelector('.dropzone-previews').style.display = 'block';
        var filesEl= document.querySelectorAll('#myId .dropzone-previews .dz-preview');
        if(filesEl.length>1){
            filesEl[0].remove();
        }
    });
    myDropzone.on("success", function(file,res) {
        document.getElementById('treeinformation-tree_image').value = res.data.path;
    });
    myDropzone.on("removedfile", function(file) {
        var url = document.getElementById('treeinformation-tree_image').value;
        url = '/upload/' + url.split('/upload/')[1];
        delImg(url);
    });
    myDropzone.on("error", function(file,res) {
        console.log(file)
        console.log(res)
    });*/
    // 初始化地图
    (function init() {
        var myLatlng = new qq.maps.LatLng(34.22259,108.94878);
        //var imgUrl = document.getElementById('treeinformation-tree_image').value;
        var inputLat = document.getElementById('treeinformation-latitude').value-0;
        var inputLon = document.getElementById('treeinformation-longitude').value-0;
        console.log(inputLat, inputLon);
        // 图片地址为真
        /*if(imgUrl){
            toggle(true);
            document.querySelectorAll('.dropzone-previews img')[1].src = imgUrl;
        }*/
        var myOptions = {
            zoom: 16,
            center: myLatlng
        }
        map = new qq.maps.Map(document.getElementById("container"), myOptions);
        //创建一个Marker
        if(inputLat && inputLon){
            var latlng = new qq.maps.LatLng(inputLat,inputLon);
            marker = new qq.maps.Marker({
                //设置Marker的位置坐标
                position: latlng,
                //设置显示Marker的地图
                map: map
            });
            map.setCenter(latlng);
        }
        //添加监听事件  获取鼠标点击事件
        qq.maps.event.addListener(map, 'click', function(event) {
            //清除Marker
            if(marker){
                marker.setMap(null);
            }
            //创建一个Marker
            marker=new qq.maps.Marker({
                position:event.latLng, 
                map:map
            });
            //提示
            marker.setTitle("地点标记");
            setMarkerData(marker.getPosition());
        });
    })();
 }
</script>
<div class="tree-information-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','method'=>'post']]); ?>
    <?= $form->field($model, 'tree_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tree_number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'tree_image[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true,'accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择树木照片',
            'allowedFileExtensions'=>['jpg','gif','png']
        ]
    ]);?>

    <?= $form->field($model, 'tree_video')->widget(FileInput::classname(), [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'showUpload'=>false,
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择树木视频',
            'allowedFileExtensions'=>['mp4']
        ]
    ]);?>

    <?= $form->field($model, 'diameter')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'crown')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'health')->widget(Select2::classname(), [
            'data' => ['非常健康'=>'非常健康','健康'=>'健康','一般'=>'一般','较差'=>'较差','非常差'=>'非常差','死亡'=>'死亡'],
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>

    <div id="container"></div>

    <?= $form->field($model, 'nation')->textInput(['maxlength' => true,'readonly' => 'true']) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true,'readonly' => 'true']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true,'readonly' => 'true']) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>

    <?= $form->field($model, 'tree_category_id')->widget(Select2::classname(), [
            'data' => TreeCategory::getCategoryList(),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>


    <?= $form->field($model, 'conservation_unit_id')->widget(Select2::classname(), [
            'data' => ConservationUnit::getConservationList(),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'construction_unit_id')->widget(Select2::classname(), [
            'data' => ConstructionUnit::getConstructionList(),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'property_unit_id')->widget(Select2::classname(), [
            'data' => PropertyUnit::getPropertyList(),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    

    <?= $form->field($model, 'other')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
