<?php
require_once '../include.php';
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select * from shop_cate";
$totalRows=getResultNum($sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$offset=($page-1)*$pageSize;
$sql="select * from shop_cate order by id asc limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
if(!$rows){
    alertMessage("没有分类,请添加",'addCate.php');
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
                    <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addCate()">
                </div>
            </div>
            <!--表格-->
            <table class="table" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th width="15%">编号</th>
                    <th width="25%">分类</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;
                foreach ($rows as $row): ?>
                    <tr>
                        <!--这里的id和for里面的c1 需要循环出来-->
                        <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'] ?></label></td>
                        <td><?php echo $row['cName'] ?></td>
                        <td align="center"><input type="button" value="修改" class="btn" onclick="editCate(<?php echo $row['id'] ?>)"><input type="button" value="删除" class="btn" onclick="deleteCate(<?php echo $row['id'] ?>)"></td>
                    </tr>
                    <?php $i++;endforeach; ?>
                <?php if ($totalRows > $pageSize): ?>
                    <tr>
                        <td colspan="4"><?php echo showPage($page, $totalPage); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    function editCate(id){
        window.location="editCate.php?id="+id;
    }
    function deleteCate(id){
        if(window.confirm("您确定要删除吗?删除之后不可恢复!")) {
            window.location = "doAdminAction.php?act=deleteCate&id=" + id;
        }
    }
    function addCate(){
        window.location="addCate.php";
    }
</script>
</html>
