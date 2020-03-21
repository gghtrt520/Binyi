<?php
use \backend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\UserAssign;

$this->title = $user->nick_name;
$this->params['breadcrumbs'][] = ['label' => '用户管理'];
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => Url::toRoute(['view','id'=>$user->id])];
$this->params['breadcrumbs'][] = '权限分配';
AppAsset::register($this);
AppAsset::addScript($this, Yii::$app->request->baseUrl."/js/multiselect.js");
?>

<div class="user-assign">

    <div class="form-group">
        <label class="control-label" for="user-username">账号</label>
        <input type="text"  class="form-control"  value="<?=Html::encode($user->username)?>" readonly="">
        <div class="help-block"></div>
    </div>
    <div class="form-group">
        <label class="control-label" for="user-nick_name">用户名</label>
        <input type="text"  class="form-control"  value="<?=Html::encode($user->nick_name)?>" readonly="">
        <div class="help-block"></div>
    </div>

    <div class="tree-category-form">

        <?php $form = ActiveForm::begin([
            'action'=>Url::toRoute(['user/update-rule?id='.$model->id]),
            'method'=>'post'
        ]); ?>

        <?= $form->field($model, 'rule')->widget(Select2::classname(), [
                'data' => [
                    '0'=>'无权限',
                    '1'=>'所有权限',
                    '2'=>'地区权限',
                    '3'=>'养护单位权限',
                    '4'=>'施工单位权限',
                    '5'=>'产权单位权限'
                ],
                'options' => ['placeholder' => '请选择', 'multiple' => false]
        ])?>
        <!-- <div class="row">
            <div class="col-xs-5">
                <select name="from[]" id="search" class="form-control" size="8" multiple="multiple">
                    <option value="1">Item 1</option>
                    <option value="2">Item 5</option>
                    <option value="2">Item 2</option>
                    <option value="2">Item 4</option>
                    <option value="3">Item 3</option>
                </select>
            </div>
            
            <div class="col-xs-2">
                <button type="button" id="search_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="search_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
            </div>
            
            <div class="col-xs-5">
                <select name="to[]" id="search_to" class="form-control" size="8" multiple="multiple"></select>
            </div>
        </div> -->
        
        <?= $form->field($model, 'rule_data')->dropDownList(UserAssign::show($model->rule)) ?>
        <?= $form->field($model, 'is_write')->dropDownList(['可录入'=>'可录入','不可录入'=>'不可录入']) ?>
        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<script type="text/javascript">
    window.onload = function(){
        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            },
            fireSearch: function(value) {
                return value.length > 0;
            }
        });
        $("#userassign-rule").change(function() {
            showData($("#userassign-rule").val());
        });
            
        function showData(value){
            if(value == 0){
                $("#userassign-rule_data").parent().hide();
            }
            if(value == 1){
                $("#userassign-rule_data").parent().show();
                $("#userassign-rule_data").html("<option>所有权限</option>");
            }
            if(value == 2){
                $("#userassign-rule_data").parent().show();
                $("#userassign-rule_data").html("<option>请选择</option>");
                getData(value);
            }
            if(value == 3){
                $("#userassign-rule_data").parent().show();
                $("#userassign-rule_data").html("<option>请选择</option>");
                getData(value);
            }
            if(value == 4){
                $("#userassign-rule_data").parent().show();
                $("#userassign-rule_data").html("<option>请选择</option>");
                getData(value);
            }
            if(value == 5){
                $("#userassign-rule_data").parent().show();
                $("#userassign-rule_data").html("<option>请选择</option>");
                getData(value);
            }

        }
    }

    function getData(value){
        $.ajax({
            "type"  : "GET",
            "url"   : 'get-rule-data',
            "data"  : {value:value},
            success : function(data) {
                $("#userassign-rule_data").html("");
                if(value == 2){
                    $.each(data.data, function (index, item) {
                        $("#userassign-rule_data").append("<option value="+item.name +">"+item.name+"</option>"); 
                    });
                }else{
                    $.each(data.data, function (index, item) {
                        $("#userassign-rule_data").append("<option value="+item.id +">"+item.name+"</option>"); 
                    });
                }
            }
        });
    }
</script>
