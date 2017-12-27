<?php
require_once '../include.php';
$act = $_REQUEST['act'];
@$id = $_REQUEST['id'];
if ($act == "logout") {
    logout();
} elseif ($act == "addAdmin") {
    $res = addAdmin();
} elseif ($act == "editAdmin") {
    $res = editAdmin($id);
} elseif ($act == "deleteAdmin") {
    $res = deleteAdmin($id);
} elseif($act == "addCate"){
    $res = addCate();
} elseif($act == "editCate"){
    $where="id={$id}";
    $res=editCate($where);
} elseif($act == "deleteCate"){
    $res=deleteCate($id);
} elseif($act == "addPro"){
    $res=addPro();
} elseif($act == "editPro"){
    $res=editPro($id);
} elseif($act=="deletePro"){
    $res=deletePro($id);
} elseif($act=="addUser"){
    $res=addUser();
} elseif($act=="deleteUser"){
    $res=deleteUser($id);
} elseif($act=="editUser"){
    $res=editUser($id);
} elseif($act=="waterText"){
    $res=doWaterText($id);
} elseif($act=="waterPic"){
    $res=doWaterPic($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
if ($res) {
    echo $res;
}
?>
</body>
</html>