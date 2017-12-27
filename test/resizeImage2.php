<?php
require_once '../include.php';
function thumb($filename, $destination=null,$scale = 0.5, $dst_wide = null, $dst_height = null, $isReservedSource=false)
{
    //取图片的宽,高,类型
    list($src_wide, $src_height, $src_type) = getimagesize($filename);
    if (is_null($dst_wide) || is_null($dst_height)) {
        $dst_wide = ceil($src_wide * $scale);
        $dst_height = ceil($src_height * $scale);
    }
    //image_type_to_mime_type — 取得 getimagesize，exif_read_data，exif_thumbnail，exif_imagetype 所返回的图像类型的 MIME 类型
    $mime = image_type_to_mime_type($src_type);
    //echo $mime;//image/jpeg,image/gif
    //把imagecreatefromjpeg()函数封装
    $createFun = str_replace('/', 'createfrom', $mime);
    //把imagejpeg()函数封装
    $outFun = str_replace('/', '', $mime);
    //imagecreatefromjpeg()由文件或 URL 创建一个新图象。返回一图像标识符，代表了从给定的文件名取得的图像。既把图片转换成画布资源
    $src_image = $createFun($filename);
    //创建画布
    $dst_image = imagecreatetruecolor($dst_wide, $dst_height);
    //重构图片大小
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_wide, $dst_height, $src_wide, $src_height);
    //判断储存文件的路径是否存在如果不存在则创建
    //dirname() 函数返回路径中的目录部分。
    if ($destination && !file_exists(dirname($destination))) {
        mkdir(dirname($destination), 0777, true);
    }
    $dstFilename = $destination == null ? getUniName() . "." . getExt($filename) : $destination;
    //保存图像文件
    $outFun($dst_image, $dstFilename);

    imagedestroy($src_image);
    imagedestroy($dst_image);

    if($isReservedSource){
        unlink($filename);
    }

    return $dstFilename;


}
$filename="des_big.jpg";
thumb($filename,"image_50/{$filename}",0.5,50,50);
thumb($filename,"image_220/{$filename}",0.5,220,220);
thumb($filename,"image_350/{$filename}",0.5,350,350);
thumb($filename,"image_800/{$filename}",0.5,800,800);
