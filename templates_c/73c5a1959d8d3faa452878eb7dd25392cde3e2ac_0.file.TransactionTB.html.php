<?php
/* Smarty version 3.1.32, created on 2018-09-12 16:59:57
  from '/home/ki/https/www/framework/mvc/view/Manage/Transaction/TransactionTB.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b99460ddad007_34062426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73c5a1959d8d3faa452878eb7dd25392cde3e2ac' => 
    array (
      0 => '/home/ki/https/www/framework/mvc/view/Manage/Transaction/TransactionTB.html',
      1 => 1536771120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b99460ddad007_34062426 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form method="Post" action='/Manage/Transaction/Create'>
    <div class="container-fluid" >
      <div class ="row clearfix">  

            <div class ="col-sm-4">
                    <!--占位-->
            </div> 

                <div class ="col-sm-4" style="text-align: center">
                    <span>请输入需要操作的数据库名称</span><hr>
                    <input id='DBname' style="width:50%"required="required"  name='DBname' type="text"  aria-label="Username" aria-describedby="basic-addon1"> </input>
                    <button   type="button" onclick="GetTable()" class= 'btn btn-sm btn-dark'>确定</button>       
                </div>  
   
    </div>
  </div>

   
<?php echo '<script'; ?>
>
function GetTable(){
    var dbname = $('#DBname').val();

    $.ajax({
            type: 'Get',
            url: '/Public/DB/TableLIst',
            data:{
                db_name:dbname,
            } ,
            success: function (result) {
                var json = JSON.parse(result);
                if (json.status == true) { //success 


                
                } else {  //failed
                }
            }


}






<?php echo '</script'; ?>
>




</form><?php }
}
