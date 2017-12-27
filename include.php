<?php
/*
 * 头文件
 */
//一个脚本只能开启一次如果有多个会冲突   假设文件a.php里已经初始化了会话而文件b.php里引用了文件a.php那么文件b.php就不用再 session_start 初始化会话了
session_start();
//如果不写则html页面可能会中文乱码
header("content-type:text/html;charset=utf-8");

define("ROOT",dirname(__FILE__));

//当函数include(),require(),fopen_with_path()函数来寻找文件时候.在不设置include_path的情况下,这些函数打开文件时候默认的是以web根目录去寻找.当设置include_path以后,这些php函数就会先在指定的include_path目录下面去搜索寻找
set_include_path(".".PATH_SEPARATOR.ROOT."/lib"
    .PATH_SEPARATOR.ROOT."/core"
    .PATH_SEPARATOR.ROOT."/configs"
    .PATH_SEPARATOR.get_include_path());
//echo get_include_path().'<br/>';
require_once 'image.func.php';
require_once 'mysql.func.php';
require_once 'admin.inc.php';
require_once 'common.func.php';
require_once 'page.func.php';
require_once 'cate.inc.php';
require_once 'upload.func.php';
require_once 'string.func.php';
require_once 'pro.inc.php';
require_once 'album.inc.php';
require_once 'user.inc.php';


