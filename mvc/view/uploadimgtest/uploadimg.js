

function uploadimg(){
 
  var formData =  new FormData($('form')[0]);
 // var fileList = $("#img").files;      //获取文件
 // formData.append('jpg', fileList[0]); //添加文件 
  $.ajax({
    type: 'Post',
    processData: false,//用于对data参数进行序列化处理 这里必须false
    contentType: false, //必须 
    url: '/Public/Upload/UploadImg',
    data:formData,
    success: function (result) {
        var json = JSON.parse(result);
        if (json.status == true) { //success 
             alert(json.msg);
        } else {  //failed
        }
    }
})// ajax end
 
}