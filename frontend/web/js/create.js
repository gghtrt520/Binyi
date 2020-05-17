function GetAge(strBirthday, deathDay) {
  var returnAge,
    strBirthdayArr = strBirthday.split("-"),
    birthYear = strBirthdayArr[0],
    birthMonth = strBirthdayArr[1],
    birthDay = strBirthdayArr[2],
    d = new Date(),
    deathDayArr = deathDay.split("-"),
    nowYear = deathDayArr[0],
    nowMonth = deathDayArr[1],
    nowDay = deathDayArr[2];
  if (nowYear == birthYear) {
    returnAge = 0;//同年 则为0周岁
  }
  else {
    var ageDiff = nowYear - birthYear; //年之差
    if (ageDiff > 0) {
      if (nowMonth == birthMonth) {
        var dayDiff = nowDay - birthDay;//日之差
        if (dayDiff < 0) {
          returnAge = ageDiff - 1;
        } else {
          returnAge = ageDiff;
        }
      } else {
        var monthDiff = nowMonth - birthMonth;//月之差
        if (monthDiff < 0) {
          returnAge = ageDiff - 1;
        }
        else {
          returnAge = ageDiff;
        }
      }
    } else {
      returnAge = -1;//返回-1 表示出生日期输入错误 晚于今天
    }
  }
  // return returnAge;//返回周岁年龄
  $("#age").val(returnAge);
}

function initDatePicker(el, defalut, startDate, endDate) {
  var time = new Date();
  var mtime = time.getFullYear() + '-' + (time.getMonth() + 1 < 10 ? '0' + (time.getMonth() + 1) : time.getMonth() + 1) + '-' + (time.getDate() < 10 ? '0' + (time.getDate()) : time.getDate());
  var option = {
      format: 'yyyy-mm-dd',
      language: 'zh-CN',
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      forceParse: 0,
      minView: 2,
      startDate: '',
  }
  if (endDate) {
      option.endDate = mtime;
  }
  if (el instanceof Array) {
      var sinput = $(el[0]).find("input");
      var einput = $(el[1]).find("input");
      $(el[0]).datetimepicker($.extend(option, defalut)).on('changeDate', function (ev) {

          //结束时间最早不能小于起始时间
          $(el[1]).datetimepicker('setStartDate', sinput.val());

          //当起始时间大于结束时间时，将两个时间都设置为起始时间
          if (ev.date > new Date(einput.val())) {
              einput.val(sinput.val())
              $(el[1]).datetimepicker('update');

              //当结束时间为空的时候，设置为起始时间
          } else if (einput.val() == "") {
              einput.val(sinput.val());
          }
          GetAge(sinput.val(),einput.val());
      })
      $(el[1]).datetimepicker(option, defalut).on('changeDate', function (ev) {
          if (sinput.val() == "") {
              sinput.val(einput.val());
              $(el[1]).datetimepicker('setStartDate', sinput.val());
          }
          GetAge(sinput.val(),einput.val());
      });
      if (defalut) {
          sinput.val(mtime);
          einput.val(mtime);
      }
      if (startDate) {
          $(el[0]).datetimepicker('setStartDate', mtime);
          $(el[1]).datetimepicker('setStartDate', mtime);
      }
  } else {
      $(el).datetimepicker(option);
      if (defalut) {
          $(el).val(mtime);
      }
  }
}
var $image = $('#preview');
initDatePicker(['.start-time', '.end-time'], true, false, true);
$('#imgPicker').bind('change', function() {
  //当没选中图片时，清除预览
  if (this.files.length === 0) {
      $('#preview').attr("src", "");
      return;
  }
  //实例化一个FileReader
  var reader = new FileReader();
  reader.onload = function(e) {
      $('#preview').attr("src", e.target.result);
      $image.cropper({
          aspectRatio: 1 / 1,
          preview: "#preview",
          dragMode: "none",
          modal: true,
          guides: true,
          autoCrop: true,
          autoCropArea: 0.8,
          movable: true,
          scalable: true,
          zoomable: true,
          wheelZoomRatio: 0.1,
          cropBoxMovable: true,
          cropBoxResizable: false,
      })
      // 重选图片时重绘
      $image.cropper('replace', $image.attr("src"), false);
  };
  reader.readAsDataURL(this.files[0]);
});
$(".comBtn").on("click", function() {
    var cas = $image.cropper('getCroppedCanvas');
    if(!cas){
    	return;
    }
    cas.toBlob(function(e) {
        // console.log(e); //生成Blob的图片格式
        var formData = new FormData();
        var fileName = new Date().getTime() + '.png';
        formData.append('Room[avatar_url]', e, fileName);
        $(".dialog-wrap").hide();
        $.ajax('/auth/upload', {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $(".avator img").attr("src", data.data.path);
                $(".avator input").val(data.data.path);
            },
            error: function() {
                 console.log('Upload error');
            }
        });
    });
})
$(".celBtn").on("click",function(){
	$(".dialog-wrap").hide();
});
$(".avator img").on("click",function(){
  $(".dialog-wrap").show();
});
$("button.cancel").on("click",function(){
  window.location.href = "/auth/myself";
});
$("button.save").on("click",function(){
  var $form = $("form.form-horizontal");
  var avatar_url = $form.find(".avator img").attr("src");
  var name = $form.find(".avator img").attr("src");
  var gender = $('input:radio[name=sex]:checked').val();
  var birthdate = $(".start-time input").val();
  var death = $(".end-time input").val();
  var age = $("#age").val();
  var description = $("#jiyu").val();
  var province = $("#province").val();
  var city = $("#city").val();
  var area = $("#jiyu").val();
  var rule = $(".rule").val();
  if (name == "") {
    $("body").xTip({
        type: "warning",
        message: "请输入逝者姓名"
    });
    return;
  }
  if (description == "") {
    $("body").xTip({
        type: "warning",
        message: "请输入寄语"
    });
    return;
  }
  if (age == "") {
    $("body").xTip({
        type: "warning",
        message: "请选择生辰忌日"
    });
    return;
  }
  if (avatarUrl) {
    $("body").xTip({
        type: "warning",
        message: "请上传头像照片"
    });
    return;
  }
  var params = {
    "avatar_url":avatar_url,
    "name": name,
    "gender": gender,
    "birthdate": birthdate,
    "death": death,
    "age": age,
    "description": description,
    "province": province,
    "city": city,
    "area": area,
    "category": '免费',
    "rule": rule
  }
  $.ajax('/site/add', {
      method: "POST",
      data: params,
      success: function(data) {
        console.log(data);
        window.location.href = "/auth/myself";
      },
      error: function() {
           console.log('error');
      }
  });
});