<?php
/*
*   入口文件
*   进入分发逻辑
*   App_Ctr_模块名_控制器名  （控制器名称）
*             |       v-->模块名，控制器名必须和文件同名（区分大小写）重要
*              ->对应文件夹名称
*          /模块/控制器/方法 ->   xxxAction()
*              模块名，控制器名必须和文件同名（区分大小写）重要
*/

namespace {
include_once "inc.php"; 
        $app = new App();
        $app ->Run($config);
}
?>