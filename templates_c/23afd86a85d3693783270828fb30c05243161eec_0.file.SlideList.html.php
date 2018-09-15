<?php
/* Smarty version 3.1.32, created on 2018-09-12 18:08:25
  from '/home/ki/https/www/framework/mvc/view/Manage/Slide/SlideList.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b99561964d835_88702151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23afd86a85d3693783270828fb30c05243161eec' => 
    array (
      0 => '/home/ki/https/www/framework/mvc/view/Manage/Slide/SlideList.html',
      1 => 1536265022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b99561964d835_88702151 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table class="table">
    <thead>
      <tr>
        <th scope="col">微缩图</th>
        <th scope="col">日期</th>
        <th scope="col">操作</th>
      </tr>
    </thead>
    <tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'row', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['row']->value) {
?> 
      <tr>
        <td><img id ='img<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' style="height:50px;width:auto" src="<?php echo $_smarty_tpl->tpl_vars['row']->value['s_url'];?>
"></td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['s_date'];?>
  </td>
        <td>
             <a href='#' onclick="k_crop( <?php echo $_smarty_tpl->tpl_vars['row']->value['s_id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['row']->value['s_url'];?>
','img<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' )" class="btn  btn-sm btn-secondary"> 替换 </a>
        </td>
      </tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
  </table

<div id ="crop" style="margin:10px;" >
    <?php echo '<script'; ?>
 src="/public/Jcrop/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/Jcrop/js/jquery.Jcrop.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/public/Jcrop/js/jquery.color.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
    // 全局存储变量
       var api =null;
       var img_info=null;  //图片路径信息
       var point =null;     //裁切坐标
       var id;
       var url;
       var img;
    
    // 外部调用函数
    function k_crop(sid,surl,imgid){
        $('#exampleModal').modal({
            backdrop:'static',
            keyboard:false
        });
        $('#exampleModal').modal('show');
        id  = sid;
        url = surl;
        img = imgid;
    }
    /* 回调函数 裁剪成功调用*/
    function crop_callback(){
        window.location.href='/Manage/Slide/Slide?id='+id+'&old_url='+url+'&new_url='+img_info['url'];
    }
    function crop($){
        jQuery(function($){
        $('#target').Jcrop({
          onSelect:showCoords,
    //      onChange:showpoint,
          bgOpacity: 0.5,   //透明度
          bgColor: 'white', //背景色
          addClass: 'jcrop-light',
          aspectRatio:16/9,  //宽高比
          boxWidth:500,
          boxHeight:500,
        //   setSelect:[20,50,50,70],   //初始化选择区域   
      },function(){ api=this;   });
    });
    }
    function showCoords(c){  //c
        point=c;
    }
    function cancel(c){
     var data={
         'path':img_info['path']
        } ;
    
        if(img_info==null){
            return;
        } else {
            $.ajax({
            type: 'Get',
            url:'/Public/Upload/DeleteFile',
            data:data,
            success: function (result) {
                var json = JSON.parse(result);
                if (json.status == true) { //success 
                    api.destroy();  
                    $("#pic").empty();  //清空div
                } else {  //failed
                    alert(json.msg);
                }
            }
          })// ajax end
        }
      }
    
    //第二此裁剪
    function saveimg(){   //cb
        if(point == null){
            return
        }
        point= JSON.stringify(point);
        data={
         'point':point,
         'path':img_info['path'],
        }
        $.ajax({
        type: 'Get',
        url: '/Public/Upload/CropImg',
        data:data,
        success: function (result) {
            var json = JSON.parse(result);
            if (json.status == true) { //success 
                $('#exampleModal').modal('hide');
                api.destroy();  
                $("#pic").empty();  //清空div
                crop_callback();
            } else {  //failed
                alert(json.msg);
            }
        }
    })// ajax end
    }
    // 第一次上传文件
    function uploadimg(){
      var formData =  new FormData($('#upload')[0]);
     // var fileList = $("#img").files;      //获取文件
     // formData.append('jpg', fileList[0]); //添加文件 
      $.ajax({
        type: 'Post',
        processData: false,//用于对data参数进行序列化处理 这里必须false
        contentType: false, //必须 
        url: '/Public/Upload/UploadImg',
        data:formData,
        success: function (result) {
            $("#target").css('');
            var json = JSON.parse(result);
            if (json.status == true) { //success 
                img_info=json.data;
                if(api !=null){
                $("#pic").empty();  //清空div
                var html="<img  id='target' src="+json.data['url']+"></img>";  //添加目标
                $("#pic").append(html);
                api.destroy();  
                crop();  //裁剪
                }else{
                var html="<img id ='target' src="+json.data['url']+"></img>";
                $("#pic").append(html);
                crop();
                }
            } else {  //failed
               alert(json.msg);
            }
        }
    })// ajax end
    }
       <?php echo '</script'; ?>
>
       <link rel="stylesheet" href="/public/Jcrop/css/jquery.Jcrop.css" type="text/css" />
    
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content"  style="width:600px;" > <!--改大小-->
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">图片裁切</h5><br>
                  <span style="font-size: 10px;">仅支持 jpg 图片格式 且最大2M </span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
    
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01"></span>
                                </div>
                                <div class="custom-file">
                                <form id="upload">
                                  <input type="file" name='img' class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                </form>
                                  <label class="custom-file-label" for="inputGroupFile01">选择文件</label>
                                </div>
                              </div>
    
                        <button type='button' class ="btn btn-info" onclick =uploadimg() >上传</button>
                   <div id="pic"> 
                   </div>
    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" onclick=cancel()  data-dismiss="modal">取消</button>
                  <button type="button" onclick=saveimg() class ="btn btn-sm btn-primary">保存</button>
                </div>
              </div>
            </div>
          </div>
     
<?php }
}
