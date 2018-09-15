<?php
/*
模型基类 
  思路：一个模型作为一个业务的实例对象
       统一定义数据接口,
  流程：
        model 数据结构定义业务所需数据 (创建模型对象时所必须)

        模型对象实例化以后 GetReqData（） 为控制器提供 数据获取清单
        InstanceMysql 将 Data 中的的 表 被实例化 Msql 对象
        handler() 函数作为公共函数处理具体业务逻辑 参数是数据 或者其他
        $Result 处理完成后的参数
数据结构:
      $this->Model = array(
*/

 
/*
*
*/
$info =array(
    'db'=>'framework',
    'table'=>array('case','admin'),
    'field'=>array('',''),
    'condition'=>array(
    array(),
    ),
);

class Model{
    protected $Information ;// 需求信息
    protected function Set($info){
      $this->Information = $info;
    }
    protected function List(){
       

    }

    protected function Edit(){

       

    }

 }









































/*     ***** version 1.0  （note: 不可控因素太多 pause 2018.8.19:3:26) ****        
   
$this->Model = array(
      'order' => array(
          #前后数据映射
          'map'=>array(   
             'id'=>'ord_id',  #库 => 前台            
          ),
          #数据输入
          'in' => array(
             'id'=> null,
          ),
          #数据输出
          'out' => null,
          #条件列表
          'condition'=>array(
              array('name'=>'ord_id','oper'=>'=','value'=>null),
          ),
          #... ...  可设置多个条件
          #mysql 实例
          'mysql'=>null,
          #api 列表(调用）  1api 2 p1 3 p2 ..(参数）
          'api' =>" getRow(\$table['condition']);",
          #消息
          'error'=>'member req stage error'
      ),
      'member' => array(
          #前后数据映射
          'map'=>array(   
            'ord_m_id'=>'m_id'
          ),
          #数据输入
          'in' => array(
          ),
          #数据输出
          'out' => null,
          #条件列表
          'condition'=>array(
              array('name'=>'m_id','oper'=>'=','value'=>null),
          ),
          #... ...  可设置多个条件
          #mysql 实例
          'mysql'=>null,
          #api 列表(调用）  1api 2 p1 3 p2 ..(参数）
          'api' =>" getRow(\$table['condition']);",
          #消息
          'error'=>'member req stage error'
      ),
    );
  }

 
    protected function Auto($ctr){
       $out=array();
       foreach(($this->Model) as $tablename => &$val){ 
          $val['mysql']=new Mysql($tablename);    
          $out = $this->stage($val,$out,$ctr);
          if($out == -1){
             return false;
          } 
       }
       return true;
    }
    private function stage(&$table,$last,$ctr){
         //填充 in
         if($this->fill($table['in'],$table['condition'],$last,$ctr,$table['map'])){
           $api = $table['api'];
           $mysql = $table['mysql'];
           $api = "return \$mysql->$api";   #调用api
           $ret = eval($api);
           $table['out'] = $ret;
           if(empty($ret)){
           trigger_error("stage mysql query empty!");
           }
           return $ret;
         } else {
           $table['message'] = 'Data filling error';
           return  -1; #数据填充失败
         }
    }
    //1 需要填充的数据 2 控制器 3上次输出
    private function fill(&$arr,&$condition,$last,$ctr,$map){
        $ctr->GetParam($arr);  #获取前端参数
        foreach($arr as $k => &$v){
              if($v == null){
                 if(array_key_exists($k,$last)){
                   $arr[$k] = $last[$k];
                 } else {
                   return false;
                 }
              }
        }
        #转换
        $this->reverse($arr,$map);
        foreach($condition as $key => &$val){
            if($val['value'] == null){
              echo  $map[$val['name']].'hhhh';
                  $kk = $map[$val['name']];//外健转换
                  echo $kk.'lll55l';
                if(array_key_exists($kk,$last)){
                   $val['value']=$last[$val['name']];
                } else if(array_key_exists($val['name'],$arr)){
                   $val['value']=$arr[$val['name']];
                } else {
                   return false;
                }
            }
        }
      return true;
    }
    private function reverse(&$in,$map){
       $input = array();
       foreach($in as $k=>$v){
         $input[$map[$k]] =$v;
       }
       $in = $input;
    }


  }

*/