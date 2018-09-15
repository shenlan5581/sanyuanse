<?php
include_once "Base.php";
class App_Controller_Manage_Slide extends Base_Manage{
      //  幻灯列表
      public function __construct() {
      parent::__construct();
      $this->ctr=new Controller;
      $this->ctr->DisplaySmart('/Manage/Slide/SlideMenu.html');
      }

  public function SlideAction(){
     $model = new App_Model_Manage_Slide; 
      $id= $this->ctr->GetParam('id');
      if($id){
        $old = $this->ctr->GetParam('old_url');
        $new = $this->ctr->GetParam('new_url');
        TOOLS\DeleteSrc($old);
        $ret=$model->Update($id,$new);
        if($ret){
           $this->ctr->MessageLocation("操作成功",'/Manage/Slide/Slide','',0);
        } else {
        TOOLS\DeleteSrc($new);
           $this->ctr->MessageLocation("操作失败",'/Manage/Slide/Slide','',0);
        }
      }
      $list  = $model->List();
      foreach($list as &$v){
       $v['s_date'] =date("Y-m-d H:i:s", $v['s_date']); 
      }
      $this->ctr->assign('list',$list);
      
      $this->ctr->DisplaySmart('/Manage/Slide/SlideList.html'); 
  }



}