<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\PropertyUnit;

$model->level -=1;
?>

<div class="tree-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province_code')->widget(Select2::classname(), [
            'data' => PropertyUnit::getProvince(),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'city_code')->widget(Select2::classname(), [
            'data' => PropertyUnit::getCityClone($model->province_code),
            'options' => ['placeholder' => '请先选择省', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'area_code')->widget(Select2::classname(), [
            'data' => PropertyUnit::getAreaClone($model->city_code),
            'options' => ['placeholder' => '请先选择市', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'level')->widget(Select2::classname(), [
            'data' => PropertyUnit::getLevelList(),
            'options' => ['placeholder' => '请先选择权限等级', 'multiple' => false]
    ])?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
            'data'    => PropertyUnit::getPropertyFather($model->level),
            'options' => ['placeholder' => '请选择', 'multiple' => false]
    ])?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="https://cdn.bootcss.com/jquery/3.4.0/jquery.js"></script>
<script type="text/javascript">
    $(function(){
        $('#propertyunit-province_code').on("select2:select", function (e) {
            var data = e.params.data;
            var id   = data.id;
            var data = {
                'province_code':id
            }
            getCityData('city',data);
            $('#propertyunit-city_code').html('<option value="0">请选择</option>');
            $('#propertyunit-area_code').html('<option value="0">请选择</option>');
        });

        $('#propertyunit-city_code').on("select2:select", function (e) {
            var data = e.params.data;
            var id   = data.id;
            var data = {
                'city_code':id
            }
            getAreaData('area',data);
            $('#propertyunit-area_code').html('<option value="0">请选择</option>');
        });

        $('#propertyunit-level').on("select2:select", function (e) {
            var data = e.params.data;
            var id   = data.id;
            var data = {
                'level':id,
                'property_unit_id':<?=Html::encode($model->id ? :0)?>
            }
            getLevelData('level',data);
            $('#propertyunit-parent_id').html('');
        });

        /* 根据所选，获取下一级的列表（市数据、区县数据） */
        function getCityData(url,data){
            $.ajax({
                url : url,
                type : "get",
                data : data,
                dataType: 'json',
                success:function (data) {
                    $.each(data.data,function(index,value){
                        var newOption = new Option(value.city_name, value.city_code, false, false);
                        $('#propertyunit-city_code').append(newOption).trigger('change'); 
                    });
                }
            });
        }

        function getAreaData(url,data){
            $.ajax({
                url : url,
                type : "get",
                data : data,
                dataType: 'json',
                success:function (data) {
                    $.each(data.data,function(index,value){
                        var newOption = new Option(value.area_name, value.area_code, false, false);
                        $('#propertyunit-area_code').append(newOption).trigger('change'); 
                    });
                }
            });
        }

        function getLevelData(url,data){
            $.ajax({
                url : url,
                type : "get",
                data : data,
                dataType: 'json',
                success:function (data) {
                    $.each(data.data,function(index,value){
                        var newOption = new Option(value.name, value.id, false, false);
                        $('#propertyunit-parent_id').append(newOption).trigger('change'); 
                    });
                }
            });
        }
    });
</script>
