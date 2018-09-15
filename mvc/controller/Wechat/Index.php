<?php
//weixin公众号

class App_Controller_Wechat_Index{
   public $ctr;
   public function __construct(){
     $this->ctr=new Controller;
   }
   public function indexAction(){









        
     $this->ctr->DisplaySmart('/Wechat/wx.html');
    }
    public function testAction(){

        







        
     
    }


















    //微信接入验证
    private function WechatCheck($token){
        $signature  =   $_GET["signature"];
        $timestamp  =   $_GET["timestamp"];
        $nonce      =   $_GET["nonce"];
        $tmpArr = array($timestamp, $nonce,$token);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr);
        $tmpStr = sha1( $tmpStr );
        
        if( $signature = $tmpStr ){
            echo $_GET['echostr'];
        return true;
        }else{
        return false;
        }
    }




}
