<?php 
class App_Model_Manage_Admin{
    private $mysql;
    public function __construct(){
        $this->mysql = new Mysql('admin');
    }
    public function List($level,$index,$count){
     $condition = array(
         array('name'=>'a_del','oper'=>'=','value'=>0),
     );
     if($level){
     $condition[] = array('name'=>'a_level','oper'=>'=','value'=>$level);
     }
      
     $sort = array('a_level'=>'desc');
     return $this->mysql->GetList($condition,$index,$count,$sort);
    }

    public function Count($level){
     $condition = array(
         array('name'=>'a_del','oper'=>'=','value'=>0),
     );
     if($level){
     $condition[] = array('name'=>'a_level','oper'=>'=','value'=>$level);
     }
     return  $this->mysql->GetCount($condition);
    }
    public function Delete($id){
     $set= array(
         'a_del'=>1,
     );
     $where= array(
         array('name'=>'a_id','oper'=>'=','value'=>$id),
     );
     return  $this->mysql->updateValue($set,$where);
    }
    public function GetInfo($id){
     $where= array(
         array('name'=>'a_id','oper'=>'=','value'=>$id),
     );
     return  $this->mysql->getRow($where);
    }
    public function Edit($name,$pass,$level,$email,$id=false){
     $set= array(
        'a_user'=>$name,
        'a_pass'=>$pass,
        'a_level'=>$level,
        'a_email'=>$email,
        'a_create_time'=>time(),
     );
     if($id){
     $where= array(
         array('name'=>'a_id','oper'=>'=','value'=>$id),
     );
       return  $this->mysql->updateValue($set,$where);
     }
     return  $this->mysql->insertValue($set);
    }
}