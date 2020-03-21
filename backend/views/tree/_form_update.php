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
</style>
<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=PHDBZ-CPACF-TIRJY-J4UTB-J67TQ-F6BBV"></script>
<script>
    
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
    // 初始化地图
    (function init() {
        var myLatlng = new qq.maps.LatLng(34.22259,108.94878);
        var inputLat = document.getElementById('treeinformation-latitude').value-0;
        var inputLon = document.getElementById('treeinformation-longitude').value-0;
        console.log(inputLat, inputLon);
        
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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'tree_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tree_image[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true,'accept' => 'image/*'],
        'pluginOptions' => [
            'uploadAsync' => false,
            'previewFileType' => 'any',
            'showUpload'=>false,
            'initialPreview'=>$image,
            'initialPreviewAsData'=>true,
            'initialCaption'=>"已上传文件",
            'initialPreviewConfig'=>$id,
            'overwriteInitial'=>false,
            'deleteUrl'=>'delete-image',
            'overwriteInitial'=>true,
            'browseLabel'=>'请选择树木照片',
            'allowedFileExtensions'=>['jpg','gif','png']
        ]
    ]);?>

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
<script type="text/javascript">
    
</script>
