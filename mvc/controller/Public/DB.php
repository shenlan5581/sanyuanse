<?php 
/*
* 公共接口获取数据库相关信息
*/
class App_Controller_Public_DB{

   public function TableListAction(){
       $ctr = new Controller;
      if(Session::IsLoginAdmin()){
          
         
    //pause

      }else{
       echo "无无限";
      }
}


}