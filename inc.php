<?php 
/*
*  定义宏
*  加载文件
*/
//directory
define('LOCALNAME','https://xingke.store');

define('DIR_ROOT', __DIR__);
define('DIR_APP',DIR_ROOT.'/app//');
define('DIR_PUB',DIR_ROOT.'/public//');
define('DIR_CTR',DIR_ROOT.'/mvc/controller/');
define('DIR_MODEL',DIR_ROOT.'/mvc/model/');
define('DIR_VIEW',DIR_ROOT.'/mvc/view/');
define('DIR_EXTENDS',DIR_ROOT.'/extend//');
define('DIR_SMARTCACHE',DIR_ROOT.'/templates_c');
define('DIR_SOURCES',DIR_ROOT.'/sources/');
define('DIR_LOG',DIR_ROOT.'/log');

//load file
include "config.php";
include DIR_APP."app.php";
include DIR_ROOT."/log/log.php";
include DIR_PUB."smarty/libs/Smarty.class.php";

//default set about url route
define('DEF_MODULE'    ,'Index');
define('DEF_CONTROLLER','Index');
define('DEF_ACTION'    ,'Index');
define('DEF_CLASS_PREFIX','App_Controller_');
define('DEF_CLASS_PREFIX','App_Model_');

define('RUNLEVEL','DEBUG');//运行级别 错误是否显示
#RELEASE
