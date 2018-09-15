<?php
/* Smarty version 3.1.32, created on 2018-09-14 12:45:18
  from '/home/k/https/www/framework/mvc/view/Manage/Sign/login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9bad5e6dadd2_87291537',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3d31da1be84150631da10e67d6a12a6436cebab' => 
    array (
      0 => '/home/k/https/www/framework/mvc/view/Manage/Sign/login.html',
      1 => 1536355386,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9bad5e6dadd2_87291537 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link  href="/public/bootstrap/css/bootstrap.css" rel="stylesheet">
<?php echo '<script'; ?>
 src="/public/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
<!-- bootstrap-->
<?php echo '<script'; ?>
 src="/public/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/storage/k.js"><?php echo '</script'; ?>
>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- bootstrap-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin-Login</title>
</head> 

<style>
</style>

<body> 

<div id='login 'style="margin-top:100px;"  >
        <div class="container">
                <div class="row clearfix">
                    <div class="col-md-4 column">
                    </div>
                    <div class="col-md-4 column">
                       
                    <h4 style="display: block" class ="m-auto"> 请先登陆 </h4><span style="color:rgb(181, 31, 31)"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
                        <form method="POST" action="/Manage/Sign/Login"   class="form-horizontal" role="form">
                            <div class="form-group">
                    <hr>
                                <div class="col-sm-12">
                                   用户名 <input required="required" name ="user"class="form-control" id="inputEmail3" type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    密码  <input required="required" name ="pass" class="form-control" id="inputPassword3" type="password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                         <label></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                    <hr>
                                     <button type="submit" class="btn btn-dark">登陆</button>
                                     <a href="#"  class="btn btn-info">注册</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-4 column">
                    </div>
                </div>
            </div>

</div>


      </body>
      </html><?php }
}
