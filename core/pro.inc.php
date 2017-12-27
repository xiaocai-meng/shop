<?php
/*
 * 添加商品
 */
function addPro()
{
    $array = $_POST;
    $array['pubTime'] = time();
    $uploadFiles = uploadFile('./uploads');
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $uploadFile) {
            thumb("./uploads/{$uploadFile['name']}", "../image_50/{$uploadFile['name']}", 0.5, 50, 50);
            thumb("./uploads/{$uploadFile['name']}", "../image_220/{$uploadFile['name']}", 0.5, 220, 220);
            thumb("./uploads/{$uploadFile['name']}", "../image_350/{$uploadFile['name']}", 0.5, 350, 350);
            thumb("./uploads/{$uploadFile['name']}", "../image_800/{$uploadFile['name']}", 0.5, 800, 800);
        }
    }
    $res = insert('shop_pro', $array);
    $pid = $res;
    if ($res) {
        if (is_array($uploadFiles) && $uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                $array1['pid'] = $pid;
                $array1['albumPath'] = $uploadFile['name'];
                addAlbum($array1);
            }
        }
        $mes = "<p>添加成功!</p><a href='addPro.php'>继续添加</a>|<a href='listPro.php'>查看商品列表</a>";
    } else {
        if (is_array($uploadFiles) && $uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                if (file_exists("uploads/{$uploadFile['name']}")) {
                    unlink("uploads/{$uploadFile['name']}");
                }
                if (file_exists("../image_800/{$uploadFile['name']}")) {
                    unlink("../image_800/{$uploadFile['name']}");
                }
                if (file_exists("../image_50/{$uploadFile['name']}")) {
                    unlink("../image_50/{$uploadFile['name']}");
                }
                if (file_exists("../image_220/{$uploadFile['name']}")) {
                    unlink("../image_220/{$uploadFile['name']}");
                }
                if (file_exists("../image_350/{$uploadFile['name']}")) {
                    unlink("../image_350/{$uploadFile['name']}");
                }
            }
        }
        $mes = "<p>添加失败!</p><a href='addPro.php'>重新添加</a>|<a href='listPro.php'>查看商品列表</a>";
    }
    return $mes;
}

/*
 * 编辑商品
 */
function editPro($id)
{
    $array = $_POST;
    $uploadFiles = uploadFile('./uploads');
    //var_dump($uploadFiles);
    if (is_array($uploadFiles) && $uploadFiles) {
        foreach ($uploadFiles as $key => $uploadFile) {
            thumb("./uploads/{$uploadFile['name']}", "../image_50/{$uploadFile['name']}", 0.5, 50, 50);
            thumb("./uploads/{$uploadFile['name']}", "../image_220/{$uploadFile['name']}", 0.5, 220, 220);
            thumb("./uploads/{$uploadFile['name']}", "../image_350/{$uploadFile['name']}", 0.5, 350, 350);
            thumb("./uploads/{$uploadFile['name']}", "../image_800/{$uploadFile['name']}", 0.5, 800, 800);
        }
    }
    $where = "id={$id}";
    $res = update('shop_pro', $array, $where);
    $pid = $id;
    if ($res === false || !$pid) {
        if (is_array($uploadFiles) && $uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                if (file_exists("uploads/{$uploadFile['name']}")) {
                    unlink("uploads/{$uploadFile['name']}");
                }
                if (file_exists("../image_800/{$uploadFile['name']}")) {
                    unlink("../image_800/{$uploadFile['name']}");
                }
                if (file_exists("../image_50/{$uploadFile['name']}")) {
                    unlink("../image_50/{$uploadFile['name']}");
                }
                if (file_exists("../image_220/{$uploadFile['name']}")) {
                    unlink("../image_220/{$uploadFile['name']}");
                }
                if (file_exists("../image_350/{$uploadFile['name']}")) {
                    unlink("../image_350/{$uploadFile['name']}");
                }
            }
        }
        $mes = "<p>编辑失败!</p><a href='editPro.php'>重新编辑</a>|<a href='listPro.php'>查看商品列表</a>";
    } else {
        if (is_array($uploadFiles) && $uploadFiles) {
            foreach ($uploadFiles as $uploadFile) {
                $array1['pid'] = $pid;
                $array1['albumPath'] = $uploadFile['name'];
                addAlbum($array1);
            }
        }
        $mes = "<p>编辑成功!</p><a href='listPro.php'>查看商品列表</a>";
    }
    return $mes;

}

/*
 * 删除商品
 */
function deletePro($id)
{
    $res1 = 1;
    $where = "id={$id}";
    $res = delete('shop_pro', $where);
    $proImgs = getAllImgByProId($id);
    if ($proImgs && is_array($proImgs)) {
        foreach ($proImgs as $proImg) {
            if (file_exists("uploads/" . $proImg['albumPath'])) {
                unlink("uploads/" . $proImg['albumPath']);
            }
            if (file_exists("../image_50/" . $proImg['albumPath'])) {
                unlink("../image_50/" . $proImg['albumPath']);
            }
            if (file_exists("../image_220/" . $proImg['albumPath'])) {
                unlink("../image_220/" . $proImg['albumPath']);
            }
            if (file_exists("../image_350/" . $proImg['albumPath'])) {
                unlink("../image_350/" . $proImg['albumPath']);
            }
            if (file_exists("../image_800/" . $proImg['albumPath'])) {
                unlink("../image_800/" . $proImg['albumPath']);
            }
        }
        $where1 = "pid=" . $id;
        $res1 = delete('shop_album', $where1);
    }
    if ($res && $res1) {
        $mes = "删除成功!<br/><a href='listPro.php'>查看商品列表</a>";
    } else {
        $mes = "删除失败!<br/><a href='listPro.php'>请重新删除</a>";
    }
    return $mes;
}

/*
 * 通过id来获取图片信息
 */
function getAllImgByProId($id)
{
    $sql = "select a.albumPath from shop_album as a where pid={$id}";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 * 通过cId来获取4条商品信息
 */
function getProsBycId($cId)
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from shop_pro as p join shop_cate as c on p.cId=c.id where p.cId={$cId} limit 4";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 * 通过id来得到商品信息
 */
function getProById($id)
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from shop_pro as p join shop_cate as c on p.cId=c.id where p.id={$id}";
    $row = fetchOne($sql);
    return $row;
}

/*
 * 根据分类(cId)来查询商品信息
 */
function checkProExist($cId)
{
    $sql = "select * from shop_pro where cId={$cId}";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 * 得到所有商品的信息
 */
function getAllPros()
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from shop_pro as p join shop_cate as c on p.cId=c.id ";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 * 通过cId来获取下4条商品信息
 */
function getSmallProsBycId($cId)
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from shop_pro as p join shop_cate as c on p.cId=c.id where p.cId={$cId} limit 4,4";
    $rows = fetchAll($sql);
    return $rows;
}

/*
 * 得到商品ID和商品名称
 */
function getProInfo(){
    $sql="select id,pName from shop_pro order by id asc";
    $rows=fetchAll($sql);
    return $rows;
}