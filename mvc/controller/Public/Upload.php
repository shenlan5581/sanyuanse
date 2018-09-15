<?php 
/*
* 图片上传公共接口
*/
class App_Controller_Public_Upload{
    private $path;
    private $local_name;
    public function __construct(){
      global $config; 
      $this->local_name = $config['local_name']; //主机名
      $this->path       = $config['sources']['UploadImagePath'];
    }
/*
* 上传图片 保存在资源文件夹且返回url   for Jcrop
*/    
public function UploadImgAction(){
    $ctr = new Controller;
    if($_FILES["img"]['error'] >0         ||  //file error
       $_FILES["img"]['size']  > 2002400   ||  //大小
       $_FILES["img"]['type'] !='image/jpeg'  //类型   
      ){
       $ctr->DisplayJson("文件上传失败",null,false);   
    }else {
      // print_r($_FILES);
       $number =  rand(0,1000000);
       $name = $number.'.jpg';
       // echo $name;
       $file = $this->path."/".$name;
       if(file_exists($file)){
          $ctr->DisplayJson("文件已存在",null,false);
        } else {
          $data =array();
          $data['url'] = "$this->local_name/UploadImage/$name";
          $data['path'] = $file;
          move_uploaded_file($_FILES['img']['tmp_name'],$file);
          $ctr->DisplayJson("成功",$data,true);
       }
    }
  }
// 图片裁切 获取路径 for Jcrop
public function CropImgAction(){
     $ctr = new Controller;
     $point= array('point'=>'str','path'=>'str');
     $position = $ctr->GetParam('point');
     $path = $ctr->GetParam('path');
     $position= json_decode($_GET['point'],true);
     if($path){
      $x1 = intval($position['x']);
      $x2 = intval($position['x2']);
      $y1 = intval($position['y']);
      $y2 = intval($position['y2']);
      $w  = intval($position['w']);
      $h  = intval($position['h']);

      $targ_w =($w-($w-$x2)-$x1);
      $targ_h =($h-($h-$y2)-$y1);
      $jpeg_quality = 90;
      $img_r = imagecreatefromjpeg($path);
      $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
     imagecopyresampled($dst_r,$img_r,
         0,0,
         $x1,$y1,
         $targ_w,$targ_h,
         $w,$h);
      imagejpeg($dst_r, $path, $jpeg_quality);
      $ctr->DisplayJson('成功');
     } else {
      $ctr->DisplayJson('路径错误',null,false);
     }
}

/*删除图片*/
public function DeleteFileAction(){
     $ctr = new Controller;
     $path = $ctr->GetParam('path');
     if($path){
        $ret = unlink($path);
        if($ret){
           $ctr->DisplayJson('成功');
        }else{
           $ctr->DisplayJson('删除失败');
        }
     } else {
      $ctr->DisplayJson('路径错误',null,false);
     }
  }

// for kindedit
public function kindeditUploadAction(){

  function alert($msg) {
    header('Content-type: text/html; charset=UTF-8');
    $json = new Services_JSON();
    echo $json->encode(array('error' => 1, 'message' => $msg));
    exit;
  }



  require_once 'JSON.php';
  //文件保存目录路
  $save_path = DIR_ROOT.'/sources/kindedit_upload/';
  //文件保存目录URL
  global $config;
  $save_url = $config['local_name'].'/kindedit_upload/';
  //定义允许上传的文件扩展名
  $ext_arr = array(
    'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
    'flash' => array('swf', 'flv'),
    'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
    'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
  );
  //最大文件大小
  $max_size = 200000;
  
  $save_path = realpath($save_path) . '/';
  
  //PHP上传失败
  if (!empty($_FILES['imgFile']['error'])) {
    switch($_FILES['imgFile']['error']){
      case '1':
        $error = '超过php.ini允许的大小。';
        break;
      case '2':
        $error = '超过表单允许的大小。';
        break;
      case '3':
        $error = '图片只有部分被上传。';
        break;
      case '4':
        $error = '请选择图片。';
        break;
      case '6':
        $error = '找不到临时目录。';
        break;
      case '7':
        $error = '写文件到硬盘出错。';
        break;
      case '8':
        $error = 'File upload stopped by extension。';
        break;
      case '999':
      default:
        $error = '未知错误。';
    }
    alert($error);
  }
  
  //有上传文件时
  if (empty($_FILES) === false) {
    //原文件名
    $file_name = $_FILES['imgFile']['name'];
    //服务器上临时文件名
    $tmp_name = $_FILES['imgFile']['tmp_name'];
    //文件大小
    $file_size = $_FILES['imgFile']['size'];
    //检查文件名
    if (!$file_name) {
      alert("请选择文件。");
    }
    //检查目录
    if (@is_dir($save_path) === false) {
      alert("上传目录不存在。");
    }
    //检查目录写权限
    if (@is_writable($save_path) === false) {
      alert("上传目录没有写权限。");
    }
    //检查是否已上传
    if (@is_uploaded_file($tmp_name) === false) {
      alert("上传失败。");
    }
    //检查文件大小
    if ($file_size > $max_size) {
      alert("上传文件大小超过限制。");
    }
    //检查目录名
    $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
    if (empty($ext_arr[$dir_name])) {
      alert("目录名不正确。");
    }
    //获得文件扩展名
    $temp_arr = explode(".", $file_name);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);
    //检查扩展名
    if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
      alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
    }
    //创建文件夹
    if ($dir_name !== '') {
      $save_path .= $dir_name . "/";
      $save_url .= $dir_name . "/";
      if (!file_exists($save_path)) {
        mkdir($save_path);
      }
    }
    $ymd = date("Ymd");
    $save_path .= $ymd . "/";
    $save_url .= $ymd . "/";
    if (!file_exists($save_path)) {
      mkdir($save_path);
    }
    //新文件名
    $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    //移动文件
    $file_path = $save_path . $new_file_name;
    if (move_uploaded_file($tmp_name, $file_path) === false) {
      alert("上传文件失败。");
    } else{
       //上传图片路径
    }

    @chmod($file_path, 0644);
    $file_url = $save_url . $new_file_name;
  
    header('Content-type: text/html; charset=UTF-8');
    $json = new Services_JSON();
    echo $json->encode(array('error' => 0, 'url' => $file_url));
    exit;
  }
  

  }











}


