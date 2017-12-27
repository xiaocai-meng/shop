<?php
require_once 'string.func.php';
/*
 * 通过GD库创建验证码
 */
function verifyImage($type = 1,$length = 4,$pixel = 0,$line = 0,$sess_name = "verify")
{
    //创建画布(创建一个真彩色的空白图片)
    $width = 80;
    $height = 28;
    $image = imagecreatetruecolor($width, $height);
    //创建画笔颜色
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $green = imagecolorallocate($image, 0x00, 0xFF, 0x00);
    //填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
    $chars = buildRandomString($type, $length);
    //print_r('q');exit;
    //把验证码信息装到session
    $_SESSION[$sess_name] = $chars;
    $fontfiles = array("FZLTCXHJW.TTF", "msyh.ttc", "msyhbd.ttc", "msyhl.ttc", "simfang.ttf", "simhei.ttf", "simkai.ttf", "simsun.ttc", "SIMYOU.TTF");
    for ($i = 0; $i < $length; $i++) {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(20, 26);
        $fontfile = "../fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $text = substr($chars, $i, 1);
        //使用 TrueType($fontfile指定的字体) 字体将 指定的 text 写入图像。
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }
    //可以使用imagesetpixel绘制点来实现噪点干扰
    if ($pixel) {
        for ($i = 0; $i < 50; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $green);
        }
    }
    //使用imageline绘制线条干扰
    if ($line) {
        for ($i = 1; $i < $line; $i++) {
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }
    //如果不写则html页面可能会中文乱码
    header("content-type:image/gif");
    imagegif($image);
    //调用imagedestroy释放该图片所占用的内存
    imagedestroy($image);
}
/*
 * 生成缩略图
 */
function thumb($filename, $destination=null,$scale = 0.5, $dst_wide = null, $dst_height = null, $isReservedSource=false)
{
    /*取图片的宽,高,类型
    getimagesize函数
    索引 0 给出的是图像宽度的像素值
    索引 1 给出的是图像高度的像素值
    索引 2 给出的是图像的类型，返回的是数字，其中1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM
    索引 3 给出的是一个宽度和高度的字符串，可以直接用于 HTML 的 <image> 标签
    索引 bits 给出的是图像的每种颜色的位数，二进制格式
    索引 channels 给出的是图像的通道值，RGB 图像默认是 3
    索引 mime 给出的是图像的 MIME 信息，此信息可以用来在 HTTP Content-type 头信息中发送正确的信息，如：
    header("Content-type: image/jpeg");*/
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
    //imagejpeg($a,$b)函数指定文件名将绘制后的图像保存到文件中,即将$a图片保存为$b图片 如果imageipeg($a)是输出图片
    $outFun($dst_image, $dstFilename);

    imagedestroy($src_image);
    imagedestroy($dst_image);

    if($isReservedSource){
        unlink($filename);
    }
    return $dstFilename;
}
/*
 * 添加文字水印
 */
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
    //header测试输出图片时候使用的,如果不注释掉,会有一个小方框
    //header("content-type:" . $mime);
    $outFun($image,$filename);
    imagedestroy($image);
}
/*
 * 添加图片水印
 */
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
    //header("content-type:" . $dstMime);
    $outDstFun($dst_im, $dstFile);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}