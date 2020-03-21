<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

\backend\assets\AppAsset::addScript($this, "/js/plugins/bootstrap-treeview/bootstrap-treeview.js");
$this->title = '产权单位';
$this->params['breadcrumbs'][] = ['label' => '树木管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<link rel="stylesheet" type="text/css" href="/js/plugins/bootstrap-treeview/bootstrap-treeview.css">

<div class="margin btn-groups text-right">
    <?=Html::a('添加产权单位', ['property-create','action'=>'clone-tree-property-unit'], ['class' => 'btn btn-success pull-left'])?>
    <button type="button" class="btn btn-primary view">查看</button>
    <button type="button" class="btn btn-primary edite">修改</button>
</div>
<div id="tree"></div>

<script>
    var selectNode;
    window.onload=function(){
    $.ajax({
      type:"get",
      url:"tree",
      data: {parent_id:0},
      success:function(data,status){
        if(data.status == 1 && data.data.length>0){
          var nodes = data.data.map(item=>{
            item.text = item.name;
            item.lazyLoad = true;
            return item;
          });
          $('#tree').treeview({
            data: nodes,
            levels: 1,
            lazyLoad:loaddata, 
            onNodeSelected: function(event, data) {
              console.log(event, data);
              selectNode = data;
            },
            onNodeUnselected: function(event, data) {
              console.log(event, data);
              selectNode = "";
            }
          });
        }else{
          alert('暂无数据')
        }
      }
    });
        
    $(".btn-groups").on('click','button',function(){
        if($(this).hasClass('view') && selectNode){
            window.location.href = 'property-view?id=' + selectNode.id+'&action=clone-tree-property-unit';
        } else if($(this).hasClass('edite') && selectNode){
            window.location.href = 'property-update?id=' + selectNode.id+'&action=clone-tree-property-unit';
        } else{
            alert('请选择一个产权级别')
        }
    });
    }

function loaddata(node,func){//这个技巧真高，即能得到节点数据，又能把节点下级的数据通过函数发回去
  $.ajax({
    type:"get",
    url:"tree",
    data: {parent_id:node.id},
    success:function(data,status){
      if(data.status == 1 && data.data.length>0){
        var nodes = data.data.map(item=>{
          item.text = item.name;
          item.lazyLoad = true;
          return item;
        });
        func(nodes);
      }else{
        alert('暂无数据')
      }
    }
  });
  console.log(1);
  // $("#tree").treeview("addNode", [singleNode,node]); //这一句和上面一句等同
}
    function getTree(id = 0) {
    // Some logic to retrieve, or generate tree structure
var tree = [
  {
    text: "Parent 1",
    lazyLoad:true
  }
];
    return tree;
  }
</script>