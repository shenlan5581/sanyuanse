<?php
  class FILE {
     private $list =array();

     //文件列表
  public function DirList($path){
               $this->list = array();
              if(empty($path)) {
                return false;
              }
              if(is_dir($path)){
                $this->build($path,$this->list);
              }
          return($this->list);
      }
    //delete dir or file
  public function delete($path){
       if(is_dir($path)){
          $this->deldir($path."/");
          rmdir($path);
          return true;
       } else {
          if(unlink($path)){
             return true;
          } else {
            return false;
          }

       }
   }

  
   // 创建文件夹 
   public function add_dir($path,$dir){
   // $dir = iconv("UTF-8", "GBK", $path."/".$dir);
    $dir =$path."/".$dir;
    if(!file_exists($dir)){
        mkdir ($dir,0777,true);
        return true;
    }  else {
        return false;
    }
}
// 创建文件
   public function add_file($path,$name){
   // $dir = iconv("UTF-8", "GBK", $path."/".$dir);
    $file =$path."/".$name; 
    if(!file_exists($file)){
        $myfile = fopen($file, "w"); 
        if($myfile){
          fclose($myfile);
          return true;
        } else{
         return false;
        }
    }  else {
        return false;
    }
}
//读取文件内容
  public function file_read($path){
         if( $file = fopen($path,"r")) {
             $content = fread($file,filesize($path));
         } else {
            return false;
         }
        if($content) {
          fclose($file);
           return $content;
        }
        fclose($file);
        return false;
   }
//清空文件 
public function file_clean($path){
    if( $file = fopen($path,"r")) {
        $content = fread($file,filesize($path));
    } else {
       return false;
    }
   if($content) {
     fclose($file);
      return $content;
   }
   fclose($file);
   return false;
}
// 写入文件
  public function file_write($path,$content){
         if( $file = fopen($path,"w")) {
            $i =  fwrite($file,$content);
            fclose($file);
            if($i == strlen($content)){
             return true;
            } else {
             return false;
            }
         } else {
            return false;
         }
   }
/*
*  递归创建 文件列表
*/
    private function build($path,&$list) {
            $dir = opendir($path);
              if(!$dir){
                  return false;
              } 
          while(($filename = readdir($dir)) !== false) {
              if($filename == '.' || $filename == '..'){
                continue;
              }
              $filepath = $path.'/'.$filename;//当前文件路径
              $type = @filetype($filepath); //类型
              $list[$filename] = array(
                      'path'=>$filepath,
                      'type'=>$type,
                      'child'=>array(),
              );
              if($type == 'dir'){
                      $this->build($filepath,$list[$filename]['child']);
              }
          }
          closedir($dir);
      }








      
   //递归删除
   private  function deldir($path){
         if(is_dir($path)){
          //扫描一个文件夹内的所有文件夹和文件并返回数组
         $p = scandir($path);
         foreach($p as $val){
          //排除目录中的.和..
          if($val !="." && $val !=".."){
           //如果是目录则递归子目录，继续操作
           if(is_dir($path.$val)){
            //子目录中操作删除文件夹和文件
            deldir($path.$val.'/');
            //目录清空后删除空文件夹
            @rmdir($path.$val.'/');
           }else{
            //如果是文件直接删除
            unlink($path.$val);
           }
          }
         }
        }
      }
}//class end









?>