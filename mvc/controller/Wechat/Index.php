<?php

class App_Controller_Wechat_Index{
    public function indexAction(){
        
   $signature  =   $_GET["signature"];
   $timestamp  =   $_GET["timestamp"];
   $nonce = $_GET["nonce"];
   
    
    $tmpArr = array($timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $signature = $tmpStr ){
    return true;
    }else{
    return false;
    }





    }
    public function testAction(){
     
    }
}
