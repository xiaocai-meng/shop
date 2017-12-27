<?php
$srcFile="../images/logo.jpg";
$dstFile="des_big.jpg";
waterPic($dstFile);
function waterPic($dstFile,$srcFile="../images/logo.jpg",$pct=30)
{
    $srcFileInfo = getimagesize($srcFile);
    $src_w = $srcFileInfo[0];
    $src_h = $srcFileInfo[1];
    $srcMime = $srcFileInfo['mime'];
    $dstFileInfo = getimagesize($dstFile);
    $dstMime = $dstFileInfo['mime'];
    $createSrcFun = str_replace("/", "createfrom", $srcMime);
    $createDstFun = str_replace("/", "createfrom", $dstMime);
    $outDstFun = str_replace("/", null, $dstMime);
    $dst_im = $createDstFun($dstFile);
    $src_im = $createSrcFun($srcFile);
    //magecopymerge( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct ) 将 src_im 图像中坐标从 src_x，src_y 开始，宽度为 src_w，高度为 src_h 的一部分拷贝到 dst_im 图像中坐标为 dst_x 和 dst_y 的位置上。两图像将根据 pct 来决定合并程度，其值范围从 0 到 100。当 pct = 0 时，实际上什么也没做，当为 100 时对于调色板图像本函数和 imagecopy() 完全一样，它对真彩色图像实现了 alpha 透明。
    imagecopymerge($dst_im, $src_im, 0, 0, 0, 0, $src_w, $src_h, $pct);
    header("content-type:" . $dstMime);
    $outDstFun($dst_im, $dstFile);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}
