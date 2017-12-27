<?php
require_once '../include.php';
//$a='';
//if(!$a){
//    echo 1;
//}
//buildRandomString(1,4);
echo __FILE__."<br/>" ; // 取得当前文件的绝对地址，结果：D:\www\test.php
echo dirname(__FILE__)."<br/>"; // 取得当前文件所在的绝对目录，结果：D:\www\
echo dirname(dirname(__FILE__)); //取得当前文件的上一层目录名，结果：D:\
