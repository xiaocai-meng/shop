<?php
/*
 * 检查管理员是否存在
 */
function checkAdmin($sql)
{
    return fetchOne($sql);
}

/*
 * 检查是否有管理员登录
 */
function checkLogin()
{
    if (@($_SESSION['adminId'] == "" && $_COOKIE['adminId'] == "")) {
        alertMessage('请先登录', 'login.php');
    }
}

/*
 * 注销管理员
 */
function logout()
{
    unset($_SESSION);
    //print_r($_COOKIE);
    //print_r(session_name());
    //session_name()本函数可取得或者重新配置目前 Session 的名称。若无参数 name 则表示单单获取目前 Session 名称，加上参数则表示将 Session 名称设为参数 name。
    if (isset($_COOKIE[session_name()])) {
        //通过把失效日期设置为过去的日期/时间，删除一个 cookie：
        setcookie(session_name(), '', time() - 1);
    }
    if (isset($_COOKIE['adminName'])) {
        setcookie('adminName', '', time() - 1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie('adminId', '', time() - 1);
    }
    //session_destroy();
    header("location:login.php");
}

/*
 * 添加管理员
 */
function addAdmin()
{
    $res = $_POST;
    $res['password'] = md5($_POST['password']);
    if (insert('shop_admin', $res)) {
        $res = "添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    } else {
        $res = "添加失败!<br/><a href='addAdmin.php'>重新添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    }
    return $res;
}

/*
 * 得到所有的管理员信息
 */
function getAllAdmin()
{
    $sql = "select id,username,email from shop_admin";
    $res = fetchAll($sql);
    return $res;
}

/*
 * 修改管理员信息
 */
function editAdmin($id)
{
    $array = $_POST;
    $array['password'] = md5($_POST['password']);
    if (update('shop_admin', $array, "id={$id}") === false) {
        $res = "编辑失败!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    } else {
        $res = "编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }
    return $res;
}
/*
 * 修改用户信息
 */
function editUser($id)
{
    $array = $_POST;
    $array['password'] = md5($_POST['password']);
    if (update('shop_user', $array, "id={$id}") === false) {
        $res = "编辑失败!<br/><a href='listUser.php'>查看用户列表</a>";
    } else {
        $res = "编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }
    return $res;
}

/*
 * 删除管理员
 */
function deleteAdmin($id)
{
    if (delete('shop_admin', "id={$id}") ) {
        $res = "删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    } else {
        $res = "删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
    }
    return $res;
}

/*
 * 删除用户
 */
function deleteUser($id)
{
    $sql="select face from shop_user where id=".$id;
    $row=fetchOne($sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if (delete('shop_user', "id={$id}") ) {
        $res = "删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    } else {
        $res = "删除失败!<br/><a href='listUser.php'>请重新删除</a>";
    }
    return $res;
}
/*
 * 得到后台管理员分页
 */
function getAdminByPage($pageSize)
{
    global $totalRows, $page, $totalPage;
    $sql = "select * from shop_admin";
    $totalRows = getResultNum($sql);
    //echo $totalRows;
    //ceil()向上取整
    $totalPage = ceil($totalRows / $pageSize);
    @$page = $_REQUEST['page'] ? (int)$_REQUEST['page'] : 1;
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from shop_admin order by id asc limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return $rows;
}
/*
 * 得到后台用户分页
 */
function getUserByPage($pageSize){
    global $totalRows, $page, $totalPage;
    $sql = "select * from shop_user";
    $totalRows = getResultNum($sql);
    //echo $totalRows;
    //ceil()向上取整
    $totalPage = ceil($totalRows / $pageSize);
    @$page = $_REQUEST['page'] ? (int)$_REQUEST['page'] : 1;
    $offset = ($page - 1) * $pageSize;
    $sql = "select * from shop_user order by id asc limit {$offset},{$pageSize}";
    $rows = fetchAll($sql);
    return $rows;
}
/*
 * 添加用户
 */
function addUser(){
    $array=$_POST;
    $array['password']=md5($_POST['password']);
    $array['regTime']=time();
    $uploadFile=uploadFile("../uploads");
    if($uploadFile&&is_array($uploadFile)){
        $array['face']=$uploadFile[0]['name'];
    }else{
        return "添加头像失败<a href='addUser.php'>重新添加!</a>";
    }
    if(insert('shop_user',$array)){
        $mes="添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看列表</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="添加失败!<br/><a href='addUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
    }
    return $mes;
}


























