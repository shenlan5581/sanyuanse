<?php
/* 控制器组建类  
*  职责：
*      获取前端数据输入
* 
*/ 
include_once DIR_ROOT.'/extend/controller/clean.php';
class Controller{  
 private $smart;
 public function __construct(){
   include_once DIR_ROOT.'/public/smarty/libs/Smarty.class.php';
   $this->smart = new Smarty();
 }

//以数组方式获取参数
//  GetParam('a','b');
 public function GetParam($param,$method='GET'){
    $ret = $param;
    if(is_array($ret)){        //数组获取
      foreach($ret as  $key =>&$value) {
        if($method =='GET'){
          $val = (isset($_GET[$key]))?$_GET[$key]:"";
          $type = $value.'val';
          $value = $type($this->Clean($val));
        } else if ($method =='POST'){
          $val = (isset($_POST[$key]))?$_POST[$key]:"";
          $type = $value.'val';
          $value = $type($this->Clean($val));
        }
      }
      return $ret;
    } else {                    //单值获取
        if($method =='GET'){
          $val = (isset($_GET[$param]))?$_GET[$param]:"";
          return  $this->Clean($val);
        } else if ($method =='POST'){
          $val = (isset($_POST[$param]))?$_POST[$param]:"";
          return  $this->Clean($val);
        }
    }
}
/*
*   这两个函数动态添加 message (需求 jquery 以及页面中用来定位的 MSG 元素) 
*   重要 必须在 页面中创建 id = MSG 元素 (span 不影响布局） 该函数自动添加 消息
*   参数1 消息    
*   msg2 为小字体 提示 默认为无
*/
 public function Message($msg,$msg2=''){
  $html="     
    <style> 
      #msg {
        display:inline-block;
        margin-left:25%;
        color:rgb(218, 59, 59);
        font-size:15px;
        font-weight:900;
      }
    </style>
    <script>
    $(document).ready(function(){
      var html=\"<span id ='msg'> $msg <span style='font-weight:300;font-size:12px;color:rgb(150,150,150)'> $msg2 </span></span>\";
              $('#MSG').append(html);
     setTimeout(\"$('#msg').fadeOut('slow')\",3000);
     setTimeout(\" $('#msg').remove()\",6000);
   });
    </script>  
  ";
 echo $html;
 }
 public function MessageLocation($msg,$url,$msg2='',$time=3000){
  $html="    
  <style> 
  #msg {
    display:inline-block;
    margin-left:25%;
    color:rgb(218, 59, 59);
    font-size:15px;
    font-weight:900;
  }
</style>
<script>
$(document).ready(function(){
  var html=\"<span id ='msg'> $msg <span style='font-weight:300;font-size:12px;color:rgb(150,150,150)'> $msg2 </span></span>\";
          $('#MSG').append(html);
     setTimeout(\"window.location.href='$url'\",$time)
   });
    </script>  
  ";
 echo $html;
 }
 public function GetJson(){
    echo "none";
 }

 /************输出**********/
 /*
 *   输出 smart 数据
 */
 public function assign($key,$val){
   $this->smart->assign($key,$val);
 }
 /*
 *   输出 smart 页面
 */
 public function DisplaySmart($file){
   $file =DIR_VIEW.$file; 
   $this->smart->display($file);
 }
 /*
 *   输出json串 
 */
 public function DisplayJson($msg='',$data=array(),$status=true){
    $arr = array();
    $arr['msg'] =$msg ;
    $arr['data'] =$data ;
    $arr['status'] =$status ;
    $arr['ec']=200;
    echo json_encode($arr);       
 }

 public function CleanCache(){
   $this->smart->clearAllCache();
 }








/* private ***************** 过滤*/
 //输入过滤 
 // 以下调用了不同的过滤（注意）







private function Clean($str){  
    #替换成实体字符
    $str=htmlspecialchars($str);
    #使用字符串替换‘<','>' 失效
    $str = $this->CleanBy_str_replace($str);
    #mysql 过滤
    #
    #Clean.php
    $str = CLEAN\cleanJsCss($str);
    $str = CLEAN\cleanYellow($str);
    return $str;
 }
/*  function by k
*   自写替换 可以临时用
*/
 private function CleanBy_str_replace($str){ #by self
   return  str_replace(
     array(
       'script',
       'php'
     ),
     array( 
       '*',
       '*'
     ),
   $str);
 }







}//class end


