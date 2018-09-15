<?php
class App_Controller_Wxccsj_Home{
   public $ctr;
public function __construct(){
   $this->ctr = new Controller;
   }

public function CaseAction(){
    $model = new App_Model_Manage_Case;
    $list = $model->list(0,5);
    $data =array();
    foreach($list as $k=>$val){
      $data[]=array(
         'img'=>$val['c_title_img'],
         'title'=>$val['c_title'],
         'biref'=>$val['c_biref'],
         'article'=>htmlspecialchars_decode($val['c_article']),
      );
    }
    $style = $this->Case_Style();
    $ret= array('style'=>$style,'data'=>$data);
    $this->ctr->DisplayJson('success',$ret);  
}

 

 

/* 
返回整个数组或者 某个值
*/
    private function Case_Type($nb=false){
     $type =array(
       '1'=>'家装',
       '2'=>'酒店',
       '3'=>'服饰',
       '4'=>'餐饮',
       '5'=>'教育',
       '6'=>'医疗',
       '7'=>'会所',
     );
     if($nb){
        return $type[$nb];
     } else {
        return $type;
     }
    }
    private function Case_Style($nb=false){
    $style=array(
       '1'=>'欧式',
       '2'=>'美式',
       '3'=>'中式',
       '4'=>'田园',
       '5'=>'混搭',
       '6'=>'东南亚',
       '7'=>'现代',
     );
     if($nb){
      return $style[$nb];
   } else {
      return $style;
   }
 }







}//class end
