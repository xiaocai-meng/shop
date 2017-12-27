<?php
require_once '../include.php';
header("content-type:text/html;charset=utf-8");
//$_FILES的内容是一个二维数组,里面装了图片的信息
//print_r($_FILES);
$filename=$_FILES['myFile']['name'];
$type=$_FILES['myFile']['type'];
//上传的文件在服务器建立的临时文件位置
$tmp_name=$_FILES['myFile']['tmp_name'];
//错误信息0为成功
$error=$_FILES['myFile']['error'];
$size=$_FILES['myFile']['size'];
$allowExt=array("gif","jpeg","jpg","png");
$maxSize=2097152;
//获得文件的后缀既扩展名
$ext=getExt($filename);
$filename=getUniName().".".$ext;
$path="uploads";
//判断上传目录存在与否,如果不存在就创建该目录
if(!file_exists($path)){
    //mkdir() 函数创建目录
    mkdir($path,0777,true);
}
$destination=$path."/".$filename;
/*
 * 判断错误信息
 */
//或者$error==0
if($error==UPLOAD_ERR_OK){
    //判断文件的扩展名是否为我们所规定的
    if(!in_array($ext,$allowExt)){
        exit("非法文件类型");
    }
    //限制文件上传大小
    if($size>$maxSize){
        exit("文件不允许超过2M,请压缩后上传");

    }
    //验证图片是不是一个真正的图片类型(有可能gif后缀的文件里面并不是图片)
    //取得图片的长宽
    $info=getimagesize($tmp_name);
    //var_dump($info);exit;
    if(!$info){
        exit("不是真正的图片类型");
    }
    //判断是否通过HTTP POST方式上传上来的
    if(is_uploaded_file($tmp_name)){
        //把临时文件移动到指定的目录下
        if(move_uploaded_file($tmp_name,$destination)){
            $mes="文件上传成功";
        }else{
            $mes="文件移动失败";
        }
    }else{
        $mes="不是通过HTTP POST方式上传上来的";
    }
}else{
    switch ($error){
        case 1:
            //UPLOAD_ERR_INI_SIZE
            $mes="超过了配置文件上传文件的大小";
            break;
        case 2:
            //UPLOAD_ERR_FORM_SIZE
            $mes="超过了表单设置上传文件的大小";
            break;
        case 3:
            //UPLOAD_ERR_PARTIAL
            $mes="文件部分被上传";
            break;
        case 4:
            //UPLOAD_ERR_NO_FILE
            $mes="没有文件被上传";
            break;
        case 6:
            //UPLOAD_ERR_NO_TMP_DIR
            $mes="没有找到临时目录";
            break;
        case 7:
            //UPLOAD_ERR_CANT_WRITE
            $mes="文件不可写";
            break;
        case 8:
            //UPLOAD_ERR_EXTENSION
            $mes="PHP的扩展程序中断了文件上传";
            break;

    }
}
echo $mes;