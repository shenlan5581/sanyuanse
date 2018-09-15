<?php namespace CLIENT {
/*
  php 客户端
*/




/**
** @desc 封装 curl 的调用接口，post的请求方式
**/
function Client_Post($url,$data,$timeout = 5){
    if($url == '' || $data== '' || $timeout <=0){
    return false;
    }
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_POSTFIELDS, $data);
    curl_setopt($con, CURLOPT_POST,true);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
    $result =  curl_exec($con); 
    curl_close($con);               
    return $result; 
   }

function Client_Get($url,$timeout = 5){
    if($url == '' || $timeout <=0){
    return false;
    }
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
    $result =  curl_exec($con); 
    curl_close($con);               
    return $result;
   }









}