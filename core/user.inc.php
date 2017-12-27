<?php
/*
 * 用户登录
 */

function login()
{
    $username = $_POST['username'];
    //addslashes(): 函数返回在预定义字符之前添加反斜杠的字符串。防止' or 1=1 #注入
    $username=addslashes($username);
    //或者使用mysqli_real_escape_string()
    $password = md5($_POST['password']);
    $sql = "select * from shop_user where username='{$username}' and password='{$password}'";
    //echo $sql;exit;
    //$resNum=getResultNum($sql);
    $row = fetchOne($sql);
    //echo $resNum;
    if ($row) {
        $_SESSION['loginFlag'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $mes = "登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
    } else {
        $mes = "登陆失败！<a href='login.php'>重新登陆</a>";
    }
    return $mes;
}

/*
 * 用户注册
 */
function reg()
{
    $arr = $_POST;
    //print_r($_POST);exit;
    $arr['password'] = md5($_POST['password']);
    $arr['regTime'] = time();
    $uploadFile = uploadFile();

    //print_r($uploadFile);
    if ($uploadFile && is_array($uploadFile)) {
        $arr['face'] = $uploadFile[0]['name'];
    } else {
        return "注册失败";
    }
    //print_r($arr);exit;
    if (insert("shop_user", $arr)) {
        $mes = "注册成功!<br/>3秒钟后跳转到登陆页面!<meta http-equiv='refresh' content='3;url=login.php'/>";
    } else {
        $filename = "uploads/" . $uploadFile[0]['name'];
        if (file_exists($filename)) {
            unlink($filename);
        }
        $mes = "注册失败!<br/><a href='reg.php'>重新注册</a>|<a href='index.php'>查看首页</a>";
    }
    return $mes;
}

/*
 * 用户注销
 */
function userOut(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }

    session_destroy();
    header("location:index.php");
}