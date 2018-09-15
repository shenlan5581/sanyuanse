<?php
include_once "Base.php";
/*    
后台业务管理
创建业务模型文件
*/
class App_Controller_Manage_Wechat extends Base_Manage{
    public $token;
    public function __construct() {
        parent::__construct();
        $this->ctr->DisplaySmart('/Manage/wechat/menu.html');
        $url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6edd28623a86e93f&secret=1763ee219b7c9c4951b4016ee8189d60";
        $ret=json_decode(CLIENT\Client_Get($url),true);
        $this->token =$ret['access_token'];
        }



   public function MenuAction(){ 
       $url = "https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=$this->token";
       $ret = CLIENT\Client_Get($url);
       if($ret) {
        $ret  = json_decode($ret,true);
        print_r($ret);   
        
       } else{
           echo 'kk';
       }




    
     $this->ctr->DisplaySmart('/Manage/wechat/wxmenu.html');
   }






}