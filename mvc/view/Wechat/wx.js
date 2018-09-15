
$(document).ready(function(){
   GetMaterial();
});

function GetMaterial(){
    $.ajax({
        type: 'POST',
        url: 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=1763ee219b7c9c4951b4016ee8189d60',
        data:{
            type:'image',
            offset:0,
            count:10,
        },
        success: function (result) {
            var json = JSON.parse(result);
            if (json.status == true) { //success 
                 alert(json);
            } else {  //failed
            }
        }
    })// ajax end


}

