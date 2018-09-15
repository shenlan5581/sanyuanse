<?php

class App_Controller_Index_Index{
    private $ctr;
    private $data;


      public function __construct(){
        $this->ctr=new Controller;
        $this->ctr->DisplaySmart("Index/index/layout/head.html");
      }
      public function __destruct(){
        $this->ctr->DisplaySmart("Index/index/layout/foot.html");
      }

    public function indexAction(){
        $this->ctr->DisplaySmart("Index/index/index.html");
    }






    public function formtestAction(){
        $ctr = new Controller();
        $para = array(  //数据接口定义 
            'text'=>''
        ); 
        $ctr->GetParam($para);//填充
        print_r($para);
        echo "Input test ok";
        
    }
}
