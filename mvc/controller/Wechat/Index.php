<?php

class App_Controller_Wechat_Index{
    public function indexAction(){
        
   $signature  =   $_GET["signature"];
   $timestamp  =   $_GET["timestamp"];
   $nonce      =   $_GET["nonce"];
   
    $token =  "sanyuanse";
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
    public function testAction(){
     
    }
}
