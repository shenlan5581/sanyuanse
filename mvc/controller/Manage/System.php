<?php
include_once "Base.php";
class App_Controller_Manage_System extends Base_Manage{
      // 清除缓存 
    public function CleanCacheAction(){
      $file = new FILE;
      $this->ctr->CleanCache();
      $ret = $file->delete(DIR_SMARTCACHE);
      if($ret){
      $this->ctr->Message('清除成功','已清除缓存');
      } else {
      $this->ctr->Message('清除失败','请联系管理员');
      }

   }

    public function LogAction(){
      $log=file(DIR_LOG.'/log');
      $log =array_reverse($log);
      if($log){
      $this->ctr->assign('log',$log);
      $this->ctr->DisplaySmart('/Manage/system/log.html');
      } else {
      $this->ctr->Message('日志读取失败','请联系管理员');
      }

   }
    public function CleanLogAction(){
      $log= DIR_LOG.'/log';
      if(unlink($log)){
      $this->ctr->Message('日志已清空','请联系管理员');
      } else {
      $this->ctr->Message('失败','请联系管理员');
      }

   }






}