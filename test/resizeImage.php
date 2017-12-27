<?php
$filename="des_big.jpg";
//由文件或 URL 创建一个新图象。返回一图像标识符，代表了从给定的文件名取得的图像。既把图片转换成画布资源
$src_image=imagecreatefromjpeg($filename);
list($src_wide,$src_height)=getimagesize($filename);
$scale=0.5;
$dst_wide=ceil($src_wide*$scale);
$dst_height=ceil($src_height*$scale);
$dst_image=imagecreatetruecolor($dst_wide,$dst_height);
//使用magecopyresampled()将图片缩小一半
imagecopyresampled($dst_image,$src_image,0,0,0,0,$dst_wide,$dst_height,$src_wide,$src_height);
//header("content-type:image/jpeg");
imagejpeg($dst_image,"uploads/{$filename}");
imagedestroy($src_image);
imagedestroy($dst_image);