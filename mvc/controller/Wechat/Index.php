<?php

class App_Controller_Admin_Index{
    public function indexAction(){
        echo 'admin,index';
        $ctr =new Controller();
        $db = new Mysql('member');
        $size =  $db->getCount();
        $ctr->assign('size',$size);
        $ctr->DisplaySmart("Index/index.html");
    }
    public function testAction(){
     
    }
}
