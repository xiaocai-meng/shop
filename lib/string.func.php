<?php
/*
 * 生成随机验证码
 */

function buildRandomString($type,$length)
{

    if ($type == 1) {
        //range(0,9)创建一个包含从 "0" 到 "9" 之间的元素范围的数组：
        $chars = join("", range(0, 9));
        //echo $chars;
    } elseif ($type == 2) {
        //join()把数组元素合并成字符串 array_merge()把多个数组合并成一个数组
        $chars = join("", array_merge(range("a", "z"), range("A", "Z")));
    } elseif ($type == 3) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z"), range(0, 9)));
    }
    //strlen计算字符串长度
    if ($length > strlen($chars)) {
        exit("字符串长度不够");
    }
    //str_shuffle()随机地打乱字符串中的所有字符
    $chars = str_shuffle($chars);
    //字符串截取
    return substr($chars, 0, $length);
}

/*
 * 生成唯一的字符串
 */

function getUniName(){
    //uniqid(prefix,more_entropy)   prefix可选。为 ID 规定前缀。如果两个脚本恰好在相同的微秒生成 ID，该参数很有用。 如果 more_entropy 参数设置为 true，则在返回值的末尾添加额外的熵（使用组合线形同余数生成程序），这样可以结果的唯一性更好。
    //microtime(get_as_float); 函数返回当前 Unix 时间戳的微秒数。get_as_float 	可选。当设置为 TRUE 时，规定函数应该返回一个浮点数，否则返回一个字符串。默认为 FALSE。
    return md5(uniqid(microtime(true),true));
}

/*
 * 得到文件的扩展名
 */
function getExt($filename){
    //strtolower()把所有字符转换为小写
    //end() 函数将数组内部指针指向最后一个元素，并返回该元素的值（如果成功）。
    $tmp=explode(".",$filename);
    return strtolower(end($tmp));
}
















