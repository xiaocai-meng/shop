<?php
require_once 'upload.func.php';
//print_r($_FILES);exit;
/*
 * 构建上传文件信息
 */
function buildInfo(){
    $i=0;
    foreach($_FILES as $value){
        //单文件
        if(is_string($value['name'])){
            $files[$i]=$value;
            $i++;
        }
        //多文件
        if(is_array($value['name'])){
            foreach($value['name'] as $key=>$val){
                $files[$i]['name']=$val;
                $files[$i]['size']=$value['size'][$key];
                $files[$i]['tmp_name']=$value['tmp_name'][$key];
                $files[$i]['error']=$value['error'][$key];
                $files[$i]['type']=$value['type'][$key];
                $i++;
            }
        }
    }
    return $files;
}
//print_r(buildInfo());
function uploadFile1($path = "uploads", $allowExt = array("gif", "jpeg", "jpg", "png"), $maxSize = 2097152){
    $i=0;
    $files=buildInfo();
    foreach($files as $file){
        $meses[$i]=uploadFile($file);
        $i++;
    }
    return $meses;
}
print_r(uploadFile1());