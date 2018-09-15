<?php
include_once "Base.php";
/*    
后台业务管理
创建业务模型文件
*/
class App_Controller_Manage_Transaction extends Base_Manage{
      //  幻灯列表
      public function __construct() {
      parent::__construct();
      $this->ctr->DisplaySmart('/Manage/Transaction/menu.html');
      }

public function indexAction(){
      $model = new App_Model_Manage_Transaction;
      $name =$this->ctr->GetParam('name');
      $index=$this->ctr->GetParam('index');
      $index=$index?$index:1;
      $count=10;
      $list = $model->list($index-1,$count,$name);
      $this->ctr->assign('list',$list);
      $this->ctr->DisplaySmart('/Manage/Transaction/Transaction.html');
}

public function createAction(){
     $tb =$this->ctr->GetParam('tb');   
     if($tb){



      $this->ctr->DisplaySmart('/Manage/Transaction/TransactionCreate.html');
     }else{




    // $this->ctr->DisplaySmart('/Manage/Transaction/TransactionTB.html');
     }
}





}