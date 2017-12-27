<?php
/*
 * 后台登录
 */
require_once '../include.php';
$username = $_POST['username'];
$username=addslashes($username);
$password = md5($_POST['password']);
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
@$autoFlag = $_POST['autoFlag'];
if ($verify == $verify1) {
    $sql = "select * from shop_admin where username='{$username}' and password='{$password}'";
    $res = checkAdmin($sql);
    //var_dump($res);
    if ($res) {
        //如果选了一周内自动登录
        if ($autoFlag) {
            // 发送一个一个星期过期的cookie
            setcookie("adminId", $res['id'], time() + 7 );
            setcookie("adminName", $res['username'], time() + 7 * 24 * 3600);
        }
        $_SESSION['adminName'] = $res['username'];
        $_SESSION['adminId'] = $res['id'];
        //如果登陆成功则跳转到后台页面
        header('location:index.php');
        //alertMessage('登陆成功', 'index.php');
    } else {
        alertMessage('用户名密码错误', 'login.php');
    }
} else {
    alertMessage('验证码错误', 'login.php');
}

    