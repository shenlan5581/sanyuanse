<?php namespace WECHAT {

    //微信公众号接入验证 直接在控制器文件中调用
   function WechatCheck($token){
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