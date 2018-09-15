<?php 
/*
*  日志对象
*  记录日志到文件 (配置中设置目录） 
*  调用：： trigger_errror(" msg ");
*  运行等级 为 DEBUG 时 直接输出
*          为 RELEASE 时 记录到日志文件
*/
class Log {
   private $fd;
   public function __construct($conf){
    if( $this->fd = fopen($conf['file'],"a+")) {
       set_error_handler('error', E_ALL); //函数名，收集的错误级别
    }else {
        echo "Log initialize failed";
        die();
    }
   }
public function add($string){
        if($string){
            $string="$string\n";
          fwrite($this->fd,$string);
        }
}
}
 
//$log->add('error'); 超全局变量 
function error($errno, $errstr, $errfile, $errline){ //错误编号，错误信息，错误文件，错误行号
    $errortype = array(
    E_ERROR           => 'Error',
    E_WARNING         => 'Warning',
    E_PARSE           => 'Parse',
    E_NOTICE          => 'Notice',
    E_STRICT          => 'Runtime Notice',
    E_CORE_ERROR      => 'Core Error',
    E_CORE_WARNING    => 'Core Warning',
    E_COMPILE_ERROR   => 'Compile Error',
    E_COMPILE_WARNING => 'Compile Warning',
    E_USER_ERROR      => 'User Error',
    E_USER_WARNING    => 'User Warning',
    E_USER_NOTICE     => 'User Notice'
    );
    $time = date("Y-m-d h:i:sa");
    if(RUNLEVEL == 'RELEASE'){
    $GLOBALS['log']->add("$errortype[$errno]:$errstr\n File ($errline): $errfile Time:$time \n"); //输出错误信息
    }else{
     echo  "$errortype[$errno]:$errstr\n File ($errline): $errfile \n";
    }
    } 
    //trigger_error("errmsg={$message};errcode={$code};sql={$sql}", E_USER_ERROR);
 