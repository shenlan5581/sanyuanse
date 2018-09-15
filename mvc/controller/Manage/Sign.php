<?php

use function TOOLS\Check_len;
use function TOOLS\GetProjectIndo;
/*
* admin 管理员 注册登陆相关
*/
class App_Controller_Manage_Sign{
    public function __construct(){
       if(Session::IsloginAdmin()){
          header('Location:/Manage');
       }
    }

    public function LoginAction(){
       $ctr = new Controller;
       $param = array(
           'user'=>'str',
           'pass' =>'str',
       );
          $user = $ctr->GetParam($param,'POST');
          // 参数完整 验证
          if($user['user'] && $user['pass'] ){
              $model= new App_Model_Manage_Sign;
              $ret = $model->Login($user);
              if($ret){ #查询成功
                if(TOOLS\Salt_Password($user['pass']) ===$ret['a_pass']){
                    Session::SetAdminID($ret['a_id']);
                    //跳转至首页
                    header('Location:/Manage');
                }else{
                  $message = "账户名密码不匹配";
                }
              } else {
                $message = "未找到账户信息";
              }
          } else { //无参数 显示登陆框
            $message = ' ';
          } 
       $ctr->assign('message',$message);
       $ctr->DisplaySmart('/Manage/Sign/login.html');
       return;
    }


    public function LogoutAction(){
       $ctr = new Controller;
      Session::DestoyAdmin();
       $ctr->DisplaySmart('/Manage/Sign/logout.html');
   }

    /* 注册 */
    public function RegisterAction(){
       $ctr = new Controller;
       $param = array(
           'admin'=>'str',
           'pass' =>'str',
       );
       $user = $ctr->GetParam($param);
       $info = TOOLS\GetProjectInfo();
       $message = '用户注册';
       $output= array(
         'message'=>$message,
         'info'=>   $info,
       );
       $ctr->assign('data',$output);
       $ctr->DisplaySmart('/Manage/Sign/register.html');
       return;
    }
    public function TestAction(){
      $ctr = new Controller;
      $ctr->DisplaySmart('/Manage/Admin/test.html');
   }

    /* 创建超级管理
    
    */
    public function SuperAction(){
       $ctr = new Controller;
       $model = new App_Model_Manage_Sign;
       if($model->SuperExist()){ //超级管理员存在
          header('Location:/Manage/Sign/Login');
       } else {
       $user =$ctr->GetParam('user',"POST");
       $pass =$ctr->GetParam('pass',"POST");
          $proname=$ctr->GetParam('pro_name',"POST");
          $prouser=$ctr->GetParam('pro_user',"POST");
          $protel=$ctr->GetParam('pro_tel',"POST");
          $procom=$ctr->GetParam('pro_com',"POST");
          $proaddr=$ctr->GetParam('pro_addr',"POST");
          $probrief=$ctr->GetParam('pro_brief',"POST");
          $proemail=$ctr->GetParam('pro_email',"POST");
        if($user && $pass &&$proemail &&$proname &&$prouser && $protel &&$procom &&$proaddr &&$probrief){
          $set=array(
            'a_user'=>$user,
            'a_pass'=>TOOLS\Salt_Password($pass),
            'a_email'=>'22542812@qq.com',
            'a_create_time'=>time(),
            'a_level'=>9,
          );
          $model->AddSuper($set);
          $info=array(
            'pro_name'=>$proname,
            'pro_Customer'=>$prouser,
            'pro_telephone'=>$protel,
            'pro_email'=>$proemail,
            'pro_com'=>$procom,
            'pro_addr'=>$proaddr,
            'pro_brief'=>$probrief,
            'pro_date'=>time(),
          );
          $pro = new Mysql('project');
          $pro->insertValue($info);
          header('Location:/Manage/Sign/Login');
          return;
        } 
      $ctr->DisplaySmart('/Manage/Sign/Super.html');
     }
   }




}
