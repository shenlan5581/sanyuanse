<?php

namespace PAGE{

//页面基类
//
abstract class Page{
   protected $ctr;
   protected $db;
   
   public function __construct(){
    $this->$ctr = new \Controller;
   }
}

/* 
  $data 核心数据结构
  $data =array（

  ）
*/
class PAGE_List extends Page{

}



















}//namespace end