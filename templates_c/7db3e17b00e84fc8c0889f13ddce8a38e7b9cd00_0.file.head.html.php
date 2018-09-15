<?php
/* Smarty version 3.1.32, created on 2018-09-14 12:55:30
  from '/home/ki/https/www/framework/mvc/view/Index/index/layout/head.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9bafc26746c1_62523052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7db3e17b00e84fc8c0889f13ddce8a38e7b9cd00' => 
    array (
      0 => '/home/ki/https/www/framework/mvc/view/Index/index/layout/head.html',
      1 => 1536757496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b9bafc26746c1_62523052 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link  href="/public/bootstrap/css/bootstrap.css" rel="stylesheet">
<?php echo '<script'; ?>
 type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=dpflbirZykMxB1Xp1MxSew5yyR5VrG4l"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="/public/jquery-3.3.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Index/layout/index.js"><?php echo '</script'; ?>
>


<link  href="/storage/a.css" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- bootstrap-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style> 
body{
  margin:auto;
  background-color: rgb(255, 255, 255);
  width:80%
}

#k-logo{
   width:100%;
   height:60px;
   text-align: center
}
header{

}
#k-menu{
}
#k-user{
   top:20px;;
   position:relative;
   margin-left:92%;
   display: inline-block;
   font-size: 13px;
}
#allmap{
  width: 100%;height: 500px;;overflow: hidden;margin:0;font-family:"微软雅黑";
  background-color: rgb(238, 142, 24);
}
</style>



<title>home</title>
</head>


<body>

  <div id ='k-logo'> <!--logo-->
      <span style="position:absolute;top:20px;color:rgb(0, 0, 0)"> LOGO </span> 

      <div id='k-user'>
          <a class = 'a2' href="#1">登陆</a>
          <a class = 'a2' href="#1">注册</a>
      </div>

  </div>

 <!--/menu -->
<div id='k-menu ' >    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
			  
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="navbar-nav mr-auto">
					<li class="nav-item active">
					  <a class="nav-link" href="#">主页<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="#design">工程案例</a>
					</li>
            <!--  下拉-->
          
					<li class="nav-item">
					  <a class="nav-link " href="#">线上预约</a>
          </li>

					<li class="nav-item">
					  <a class="nav-link " href="#">装修小知识</a>
					</li>

					<li class="nav-item">
					  <a class="nav-link " href="#">服务保障</a>
					</li>

					<li class="nav-item">
					  <a class="nav-link " href="#">优惠活动</a>
          </li>

          
					<li class="nav-item">
					  <a class="nav-link " href="#">关于我们</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link " href="#">小程序</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link " href="#">公众号</a>
					</li>
				  </ul>
				  <form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
				  </form>
				</div>
			  </nav>
 </div>
 <!--/menu end -->

<hr>


 <!-- 轮拨-->
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
      <img class="d-block w-100" style ="height:500px;width:auto"src="/sites/Manage/1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
      <img class="d-block w-100" style ="height:500px;width:auto"src="/sites/Manage/3.jpg"  alt="Second slide">
      </div>
      <div class="carousel-item">
      <img class="d-block w-100" style ="height:500px;width:auto"src="/sites/Manage/1.jpg"  alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
 <!-- 轮拨-->
<br>

<?php }
}
