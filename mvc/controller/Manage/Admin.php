<?php

use function TOOLS\check_exiset;
include_once "Base.php";
class App_Controller_Manage_Admin extends Base_Manage{
    public function __construct() {
        parent::__construct();
        if($this->USER['a_level'] < 3){
           $this->ctr->MessageLocation('您无权查看此页面','/Manage');
           die();//退出
        }
        $this->ctr->DisplaySmart('/Manage/Admin/AdminMenu.html');
    }

      //  管理员列表
    public function AdminAction(){
        //1  分页显示
        //2  操作
        $model=new App_Model_Manage_Admin;
        $oper= $this->ctr->GetParam('oper');
        if($oper && $oper =='delete'){
           $id = $this->ctr->GetParam('id');
           if($model->Delete($id)){       
            if($id ==$this->USER['a_id']){
           Session::DestoyAdmin();
           $this->ctr->MessageLocation('删除成功','/Manage','您删除了当前登陆账户-当前登陆即将注销');
            }else{
           $this->ctr->Message('删除成功');
            }
           }else{
           $this->ctr->Message('删除失败');
           }
        }
        $index= $this->ctr->GetParam('index');
        $level= $this->ctr->GetParam('level');
        $count= $model->Count($level);
        $items=10;
        $index=$index?$index:1;//默认第1页
        $list= $model->List($level?$level:false,($index-1)*$items,$items); //这里index代表 起始位置 所以第一页是0开始
        $count =  ceil ($count/$items);
        $this->ctr->assign('level',$level?$level:false);
        $this->ctr->assign('list',$list);
        $this->ctr->assign('count',$count);
        $this->ctr->assign('curr_count',$index);
        $this->ctr->DisplaySmart('/Manage/Admin/AdminList.html');
       }

    public function AdminEditAction(){
        // 编辑 
        $id = $this->ctr->getparam('id');
        $edit_id=$this->ctr->getparam('edit_id', 'POST');
        $model=new App_Model_Manage_Admin;
        $commit=$this->ctr->getparam('oper','POST');
        if($commit){ //提交
            $edit_name=$this->ctr->getparam('name',  'POST');
            $edit_pass1=$this->ctr->getparam('pass1','POST');
            $edit_pass2=$this->ctr->getparam('pass2','POST');
            $edit_email=$this->ctr->getparam('email','POST');
            $edit_level=$this->ctr->getparam('level','POST');
            if(TOOLS\Check_name_len($edit_name) && 
                TOOLS\Check_pass_len($edit_pass1) &&
                $edit_level<4 &&$edit_level>0 &&
                $edit_pass1 === $edit_pass2  ) {
                if($edit_id){  //更新
                    $ret =  $model->Edit($edit_name,TOOLS\Salt_Password($edit_pass1),$edit_level,$edit_email,$edit_id);
                    if($ret){
                        $this->ctr->MessageLocation('编辑成功','/Manage/Admin/Admin');
                    }else{
                       $this->ctr->Message('编辑失败');
                    }
                } else {
                    if(!check_exiset('admin','a_user',$edit_name)){
                        $ret =  $model->Edit($edit_name,TOOLS\Salt_Password($edit_pass1),$edit_level,$edit_email);
                        if($ret){
                            $this->ctr->MessageLocation('创建成功','/Manage/Admin/Admin','即将跳转页面');
                        }else{
                       $this->ctr->Message('创建失败');
                        }
                    } else {
                       $this->ctr->Message('创建失败账户名以存在');
                    }
                }
            }else{
                    $this->ctr->Message('失败','请检查输入名称密码长度不能少于6,以及密码输入是否一致');
            }
        }
        if($id || $edit_id){ //edit
            if($row = $model->GetInfo($id?$id:$edit_id)){
                $this->ctr->assign('admin',$row['a_user']);
                $this->ctr->assign('level',$row['a_level']);
                $this->ctr->assign('id',$row['a_id']);
                $this->ctr->assign('oper','编辑');
            }
        }   //add
        $this->ctr->DisplaySmart('/Manage/Admin/AdminEdit.html');
       }


}