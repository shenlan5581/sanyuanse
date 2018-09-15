<?php
/*  全局公共函数库
*
*/
namespace TOOLS{
    /*
    *  重新设定 DB 可以在控制器中调用 重新初始化 DB
    *  (也许能针对小程序多库的方案）
    */
  function SetDB($dbname){
        global $config;
        $conf = $config['db']['default'];
        if($dbname){
        $conf['dbname'] = $dbname;
        }
        \DB::init($conf); #使用全局命名空间
  }


  function Salt_Password($pass) {
    return md5('@&!#plum'.md5($pass).'plum$^%*');
}

function Check_pass_len($pass) {
  $length = strlen($pass);
  if ($length < 6 || $length > 20) {
      return false;
  }
  return true;
}
function Check_name_len($pass) {
  $length = strlen($pass);
  if ($length < 6 || $length > 20) {
      return false;
  }
  return true;
}
function GetProjectInfo() {
    $model = new \Mysql('project');
    $where =array(
      array('name'=>'pro_id','oper'=> '=' ,'value'=>1),
    );
    return $model->getRow($where);
}

function check_exiset($table,$item,$vel){ //检测是否存在
    $model = new \Mysql($table);
    $where =array(
      array('name'=>$item,'oper'=> '=' ,'value'=>$vel),
    );
    return $model->getRow($where);
}
//根据本地url资源删除资源
function DeleteSrc($url){ 
  if($url){
    $len = \strlen(LOCALNAME);
    $path=substr($url,$len); 
    $file = new \FILE;
    if(!$file->delete(DIR_SOURCES.$path)){
      trigger_error("资源删除错误", E_USER_ERROR);
    }
  }
}

       /*  正则匹配  */
     // 获取某一字符串(需要正则）
 function Getstr($str,$regex){
      $name;
      $pattern = $regex;
      preg_match($pattern, $str,$name);
      return $name[1];
  }
  // 某字符串多次匹配 (需要正则）
 function GetstrList($str,$regex){
      $list = array();
      $pattern = $regex;
      preg_match_all($pattern, $str,$list);
      return $list[1];
  }




}