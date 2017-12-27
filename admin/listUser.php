<?php
require_once '../include.php';
$pageSize = 2;
$rows = getUserByPage($pageSize);
//print_r($rows);
if (!$rows) {
    alertMessage('没有用户,请先添加用户', 'addUser.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>-.-</title>
    <link rel="stylesheet" href="css/backstage.css">
</head>
<body>
<div class="content clearfix">
    <!--右侧内容-->
    <div class="cont">
        <div class="details">
            <div class="details_operation clearfix">
                <div class="bui_select">
                    <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addUser()">
                </div>
            </div>
            <!--表格-->
            <table class="table" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th width="15%">编号</th>
                    <th width="20%">用户名称</th>
                    <th width="20%">用户邮箱</th>
                    <th width="20%">是否激活</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;
                foreach ($rows as $row): ?>
                    <tr>
                        <!--这里的id和for里面的c1 需要循环出来-->
                        <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'] ?></label></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <?php
                            echo $row['activeFlag']==0?"未激活":"激活";
                            ?>
                        </td>
                        <td align="center"><input type="button" value="修改" class="btn" onclick="editUser(<?php echo $row['id'] ?>)"><input type="button" value="删除" class="btn" onclick="deleteUser(<?php echo $row['id'] ?>)">
                        </td>
                    </tr>
                    <?php $i++;endforeach; ?>
                <?php if ($totalRows > $pageSize): ?>
                    <tr>
                        <td colspan="5"><?php echo showPage($page, $totalPage); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
<script>
    function addUser() {
        window.location = "addUser.php";
    }
    function editUser(id) {
        window.location = "editUser.php?id=" + id;
    }
    function deleteUser(id) {
        if (window.confirm("您确定要删除吗?删除之后不可以恢复!")) {
            window.location = "doAdminAction.php?act=deleteUser&id=" + id;
        }
    }
</script>
</html>
