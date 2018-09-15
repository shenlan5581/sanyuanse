<?php
include_once "Base.php";
class App_Controller_Manage_Index extends Base_Manage{

    //首页
    public function IndexAction(){


    $info = TOOLS\GetProjectInfo();
 
    $this->ctr->assign('info',$info);
    $this->ctr->DisplaySmart('/Manage/index/home.html');
    }











}
