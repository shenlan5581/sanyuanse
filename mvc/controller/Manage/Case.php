<?php 

include_once "Base.php";

class App_Controller_Manage_Case extends Base_Manage{
    public function __construct(){
      parent::__construct();
      $this->ctr->DisplaySmart('/Manage/Case/CaseMenu.html');
    }



//  案例 
/*
*/
    public function CaseListAction(){
      $model = new App_model_Manage_Case;
      $index = $this->ctr->GetParam('index');    
      $style = $this->ctr->GetParam('style');    
      $type = $this->ctr->GetParam('type');    
      
      // 默认值
      $index=$index?$index:1;
      $style=$style?$style:null;
      $type=$type?$type:null;

      // 分页
      $index?$index:1;
      $items=10;
      $count= $model->Count($type,$style);
      $count =  ceil ($count/$items); //总页
      $list = $model->List(($index-1)*$items,$items,$type,$style);
      //信息转换
      foreach($list as $k => &$val){
         $val['c_article'] =htmlspecialchars_decode($val['c_article']); 
         $val['c_date'] =date("Y-m-d H:i:s", $val['c_date']); 
         $val['c_type'] =$this->Case_Type($val['c_type']); 
         $val['c_style'] =$this->Case_Style($val['c_style']); 
      }
      //输出     
      $this->ctr->assign('count',$count); 
      $this->ctr->assign('curr_type',$type); 
      $this->ctr->assign('curr_style',$style); 
      $this->ctr->assign('curr_count',$index?$index:1);
      $this->ctr->assign('type',$this->Case_Type());
      $this->ctr->assign('style',$this->Case_Style());
      $this->ctr->assign('list',$list);
      $this->ctr->assign('url','/Manage/Case/CaseList');
      $this->ctr->DisplaySmart('/Manage/Case/caselist.html');
    }

// 编辑 创建
public function CaseEditAction(){
      if($this->USER['a_level']<2){
       $this->ctr->MessageLocation('您的帐号无权操作','/Manage','3秒后跳转');
       die();
      }

      $model = new App_model_Manage_Case;
      $id = $this->ctr->GetParam('id');
      if(isset($_POST['oper'])){ //edit_commit
          $editid = $this->ctr->GetParam('id','POST');
          $style = $this->ctr->GetParam('style','POST');    
          $type = $this->ctr->GetParam('type','POST');    
          $title= $this->ctr->GetParam('title','POST');    
          $title_img= $this->ctr->GetParam('title_img','POST');    
          $html = $this->ctr->GetParam('html','POST');    
          $biref= $this->ctr->GetParam('biref','POST');    
          if($title&&$title_img&&$html&&$biref) {
              $set=array(
                'c_title'=>$title,
                'c_title_img'=>$title_img,
                'c_type'=>$type,
                'c_style'=>$style,
                'c_biref'=>$biref,
                'c_article'=>$html,
                'c_date'=>time(),
              );
              if($editid){
                  $ret = $model->UpdateCase($editid,$set);
              } else {
                  $ret = $model->AddCase($set);
              }
              if($ret){
                  $this->ctr->MessageLocation('操作成功','/Manage/Case/CaseList','3秒后跳转',0);
                  die();
              }else {
                  $this->ctr->Message('操作失败','请检查输入');
              }
          } else {
                  $this->ctr->Message('请检查输入');
          }
      }else{ //no commit
          if($id){
              $row = $model->GetRow($id);
              $this->ctr->assign('row',$row);
          }
      }
          $this->ctr->assign('id',$id?$id:null); 
          $this->ctr->assign('type',$this->Case_Type());
          $this->ctr->assign('style',$this->Case_Style());
          $this->ctr->DisplaySmart('/Manage/Case/CaseEdit.html');
}


//删除
public function CaseDeleteAction(){
  if($this->USER['a_level']<3){
    $this->ctr->MessageLocation('您的帐号无权操作','/Manage','3秒后跳转');
    die();
   }

      $model = new App_model_Manage_Case;
      $id = $this->ctr->GetParam('id');
      if($id){
        $ret=$model->Del($id); 
      }
      if($ret){
        $this->ctr->MessageLocation('操作成功','/Manage/Case/CaseList','3秒后跳转');
        die();
      }else{
        $this->ctr->Message('操作失败','请联系管理员');
      }
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

    public function CaseAddAction(){
      $content=null;
      $model = new App_model_Manage_Case;
    if(isset($_POST["html"])){
     
      $content = $this->ctr->GetParam("html",'POST');
      echo ($content);
      $set=array(
        'c_title'=>'test',
        'c_url'=>'test',
        'c_articel'=> $content,
        'c_date'=>time(),
      );
      $model->AddCase($set);
    } else{
    }
   }



}
