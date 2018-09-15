<?php 
/* 后台业务管理
*
*/
 class App_Model_Manage_Transaction{
    private  $mysql ;
    public function __construct(){
    $this->mysql = new Mysql("transaction");
    }

 
    public function list($index=0,$count=10,$name=false){
        $where=array();
        if($name){
            $where[] = array('name'=>'tr_name','oper'=>'like','value'=>$name);
        }
        return $this->mysql->getList($where,$index,$count);
    }
}