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
      })
      $(el[1]).datetimepicker(option, defalut).on('changeDate', function (ev) {
          if (sinput.val() == "") {
              sinput.val(einput.val());
              $(el[1]).datetimepicker('setStartDate', sinput.val());
          }
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
        console.log(e); //生成Blob的图片格式
        var formData = new FormData();
        formData.append('Room[avatar_url]', e);
        $(".dialog-wrap").hide();
        $.ajax('/auth/upload', {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log('Upload success');
                $(".headImage").attr("src", data);
                $(".dialog-wrap").hide();
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