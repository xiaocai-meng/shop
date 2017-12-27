<?php
require_once 'upload.func.php';
require_once '../include.php';
header("content-type:text/html;charset=utf-8");
$fileinfo=$_FILES['myFile'];
$res=uploadFile($fileinfo);
echo $res;

