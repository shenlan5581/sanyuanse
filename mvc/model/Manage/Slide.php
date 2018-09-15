<?php 
class App_Model_Manage_Slide{
    private $mysql;
    public function __construct(){
     $this->mysql =new Mysql('slide');
     $this->mysql->_delete_fields = 's_del';
    }  
    
    public function List(){
        $where =array(
          );
        $sort = array('s_date'=>'desc');  
        return $this->mysql->getList($where,null,null,$sort);
    }

    public function Update($id,$url){
        $where =array(
            array('name'=>'s_id','oper'=>'=','value'=>$id)
          );
        $set = array(
            's_url'=>$url,
            's_date'=>time(),
        );  
        return $this->mysql->updateValue($set,$where);
    }
}