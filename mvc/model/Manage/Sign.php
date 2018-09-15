<?php
class App_Model_Manage_Sign{
    private $TableName = 'admin';
    public function Login($param){
        $mysql = new Mysql($this->TableName);
        $condition = array(
          array('name'=>'a_user','oper'=>'=','value'=>$param['user']),
          array('name'=>'a_del','oper'=>'=','value'=>0),
        );
        return $mysql->getRow($condition); 
    }
    public function GetAdminInfoByID($id){
        $mysql = new Mysql($this->TableName);
        $condition = array(
          array('name'=>'a_del','oper'=>'=','value'=>0),
          array('name'=>'a_id','oper'=>'=','value'=>$id),
        );
        return $mysql->getRow($condition); 
    }

/*检测超级用户是否存在*/    
 public function SuperExist(){
        $mysql = new Mysql($this->TableName);
        $condition = array(
          array('name'=>'a_level','oper'=>'=','value'=>4),
          array('name'=>'a_del','oper'=>'=','value'=>0),
        );
        return $mysql->getRow($condition); 
    }

 public function AddSuper($set){
        $mysql = new Mysql($this->TableName);
        return $mysql->insertValue($set); 
    }
}