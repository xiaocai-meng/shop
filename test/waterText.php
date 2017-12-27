<?php
$filename="des_big.jpg";
waterText($filename);
function waterText($filename,$text="京西",$fontfile="msyh.ttc")
{
    $fileInfo = getimagesize($filename);
    //print_r($fileInfo);exit;
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun = str_replace("/", null, $mime);
    $image = $createFun($filename);
    //imagecolorallocatealpha ( resource $image , int $red , int $green , int $blue , int $alpha )的行为和 imagecolorallocate() 相同但多了一个额外的透明度参数 alpha，其值从 0 到 127。0 表示完全不透明，127 表示完全透明。创建画笔颜色
    $color = imagecolorallocatealpha($image, 255, 0, 0, 50);
    $fontfile = "../fonts/{$fontfile}";
    imagettftext($image, 14, 0, 50, 150, $color, $fontfile, $text);
    header("content-type:" . $mime);
    $outFun($image,$filename);
    imagedestroy($image);
}