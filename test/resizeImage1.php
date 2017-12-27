<?php
$filename="des_big.jpg";
list($src_wide,$src_height,$src_type)=getimagesize($filename);
//image_type_to_mime_type — 取得 getimagesize，exif_read_data，exif_thumbnail，exif_imagetype 所返回的图像类型的 MIME 类型
$mime=image_type_to_mime_type($src_type);
//echo $mime;//image/jpeg,image/gif
$createFun=str_replace('/','createfrom',$mime);
$outFun=str_replace('/','',$mime);
//把imagecreatefromjpeg()函数封装
$src_image=$createFun($filename);
$dst_50_image=imagecreatetruecolor(50,50);
$dst_220_image=imagecreatetruecolor(220,220);
$dst_350_image=imagecreatetruecolor(350,350);
$dst_800_image=imagecreatetruecolor(800,800);
//重构图片大小
imagecopyresampled($dst_50_image,$src_image,0,0,0,0,50,50,$src_wide,$src_height);
imagecopyresampled($dst_220_image,$src_image,0,0,0,0,220,220,$src_wide,$src_height);
imagecopyresampled($dst_350_image,$src_image,0,0,0,0,350,350,$src_wide,$src_height);
imagecopyresampled($dst_800_image,$src_image,0,0,0,0,800,800,$src_wide,$src_height);
//把imagejpeg()函数封装
$outFun($dst_50_image,"uploads/image_50/{$filename}");
$outFun($dst_220_image,"uploads/image_220/{$filename}");
$outFun($dst_350_image,"uploads/image_350/{$filename}");
$outFun($dst_800_image,"uploads/image_800/{$filename}");
imagedestroy($src_image);
imagedestroy($dst_50_image);
imagedestroy($dst_220_image);
imagedestroy($dst_350_image);
imagedestroy($dst_800_image);

