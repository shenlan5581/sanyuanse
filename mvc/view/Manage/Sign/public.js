$(document).ready(function(){

});


function CheckLoginFrom(form){
 var admin = (form.admin.value.length);
 var  pass = (form.pass.value.length);
     if(admin < 6 || admin > 30 || pass < 6 || pass>30){
       $('#message').html("用户名或密码长度错误,请重新输入");
       return false;
     } else {
       return true;
     }
}
function CheckRegisterFrom(form){
 var admin = (form.admin.value.length);
 var  pass = (form.pass.value.length);
     if(admin < 6 || admin > 30 || pass < 6 || pass>30){
       $('#message').html("用户名或密码长度错误,请重新输入");
       return false;
     } else {
       return true;
     }
}