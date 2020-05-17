/**
 * Created by Administrator on 2017/2/28 0028.
 */
//弹出登录框
function showLoginBox(){
    $(".bigBox").show();
    $(".close-icon").on("click",function(){
        $(".bigBox").hide()
    });
}
function buyBookBox(msg){
    var loginHtml='<div class="title-dialog cf"><h6 class="f_l"><i class="tip-icon"></i>提示</h6> <i class="f_r close-icon"></i> </div> <div class="content-dialog"> <h4>温馨提示</h4> <div class="tip-msg"><span>'+msg+'</span></div> <p class="tel-tip">咨询电话 : 400-888-8888</p> <div class="btn-card-div"></div> </div>';
    $(".bigBox").show();
    $(".dialog").html(loginHtml);
    $(".close-icon").on("click",function(){
        $(".bigBox").hide()
    });
}

function telBox(){
    var telHtml='<div class="title-dialog cf"><h6 class="f_l"><i class="icon-back-img2 icon-size-48-48 person-icon"></i>手机号码验证</h6></div> <div class="content-dialog"><div class="input-card2"><span><i class="icon-back-img2 icon-size-26-33 tel-icon"></i></span><label for="6"><input type="text" id="6" placeholder="请输入您的手机号"/></label></div> <div class="yzm-div-login2"><div class="yzm-input2"><span><i class="icon-back-img2 icon-size-26-33 yzm-icon"></i></span><label for="8"><input type="text" id="8" placeholder="图片验证码"/></label></div><a href=""> <div class="yzm-div2"><img src="" alt=""/></div><p>换一张</p></a></div><div class="yzm-div-login2"><div class="yzm-input2"><span><i class="icon-back-img2 icon-size-26-33 mes-icon"></i></span><label for="111"><input type="text" id="111" placeholder="短信验证码"/></label></div><div class="yzm-mes"><button>点击获取验证码</button></div></div><div class="btn-card-div2"> <button class="sure">确认</button><button class="cancel close-btn">取消</button> <p class="errorMsg">校验错误信息！</p> </div> </div>';
    $(".bigBox").show();
    $(".dialog").html(telHtml).css({"width":"560px","height":"360px","margin-top": "-200px","margin-left": "-280px"});
    $(".close-btn").on("click",function(){
        $(".bigBox").hide()
    });
    $(".sure").on("click",function(){
        console.log($("#6").val());
    });
}
$(function(){
    $(".j").on("click",function(){
        showLoginBox();
    });
    $(".buy-btn").on("click",function(){
        buyBookBox("您已报名成功，请于2017-04-28日之前来我校机构参加免费公益讲课！");
    });
    $(".buyBtn").on("click",function(){
        telBox();
    });
    $(".admission-list li").on("click",function(){
        var index=$(this).index();
        console.log(index);
        if(index>1){
            $(".money-text h4 span").text("￥0.00");
            $(".money-text p").text("需购买专家一对一服务&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ");
        }else{
            $(".money-text h4 span").text("￥5000.00");
            $(".money-text p").text("艺术类 播编导类 购买专家一对一服务均免费");
        }
        $(".admission-list li").removeClass("active-li");
        $(this).addClass("active-li");
    });
    $(".nav-txt span").on("click",function(){
        var index=$(this).index();
        $(".nav-txt span").removeClass("active-span");
        $(this).addClass("active-span");
        if(index==0){
            $(".article-div").hide().eq(0).show();
        }
        if(index==1){
            $(".article-div").hide().eq(1).show();
        }
        if(index==2){
            $(".article-div").hide().eq(2).show();
        }
        if(index==3){
            $(".article-div").hide().eq(3).show();
        }
    });
    $(".nav-txt-special span").on("click",function(){
        var index=$(this).index();
        $(".nav-txt-special span").removeClass("active-span");
        $(this).addClass("active-span");
        if(index==0){
            $(".article-div").hide().eq(0).show();
        }
        if(index==1){
            $(".article-div").hide().eq(1).show();
        }
        if(index==2){
            $(".article-div").hide().eq(2).show();
        }
        if(index==3){
            $(".article-div").hide().eq(3).show();
        }
    });
    $(".sel-span span").on("click",function(){
        var index=$(this).index();
        $(".sel-span span").removeClass("active-span");
        $(this).addClass("active-span");
        if(index==0){
            $(".input-school").hide().eq(0).show();
        }
        if(index==1){
            $(".input-school").hide().eq(1).show();
        }
    });
});

$.fn.xTip=function(options){
    var defaults={
        type:"success",
        position:"fixed",
        location:null,
        message:"",//提示消息
        showTime:2000,
        callback:"",
        fadeOutTime:1000
    };
    var opts=$.extend(defaults,options);
    // console.log($("#uedMinuteTip"))
    opts.location=[$(window).width()/2-120,"35%"];
    $("#uedMinuteTip").remove();
    var html = "";
    if(opts.type=="success"){
        html += "<div id='uedMinuteTip' class='minute-tip ue-minute-success' style='position:"+opts.position+";top:"+opts.location[1]+";left:"+opts.location[0]+"px;z-index:99999999999999;'><span class='icon-ok'></span>";
    }else{
        html += "<div id='uedMinuteTip' class='minute-tip ue-minute-warning' style='position:"+opts.position+";top:"+opts.location[1]+";left:"+opts.location[0]+"px;z-index:99999999999999;'><span class='icon-exclamation-sign'></span>";
    }
    html += opts.message + "</div>";
    $("body").append(html);
    var tip = $("#uedMinuteTip");
    var tipWidth = tip[0].offsetWidth;
    tip.css({'left':$(window).width()/2-tipWidth/2})
    setTimeout(function(){
        tip.fadeOut(opts.fadeOutTime,function(){
            $(this).remove();
        });
        if(typeof opts.callback == "function"){
            opts.callback();
        }   
    },opts.showTime);
};