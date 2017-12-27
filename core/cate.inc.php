<?php
/*
 * 添加分类
 */
function addCate(){
    $array=$_POST;
    if(insert('shop_cate',$array)){
        $mes="分类添加成功!<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类列表</a>";
    }else{
        $mes="分类添加失败!<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类列表</a>";
    }
    return $mes;
}
/*
 * 根据ID来得到指定分类信息
 */
function getCateById($id){
    $sql="select * from shop_cate where id={$id}";
    $res=fetchOne($sql);
    return $res;
}
/*
 * 修改分类信息
 */
function editCate($where){
    $array=$_POST;
    if(update('shop_cate',$array,$where)===false){
        $mes="分类修改失败!<br/><a href='listCate.php'>重新修改</a>";
    }else{
        $mes="分类修改成功!<br/><a href='listCate.php'>查看分类列表</a>";
    }
    return $mes;
}
/*
 * 删除分类信息
 */
function deleteCate($id){
    $res=checkProExist($id);
    if(!$res) {
        $where="id=".$id;
        if (delete('shop_cate', $where)) {
            $mes = "分类删除成功!<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
        } else {
            $mes = "删除失败!<br/><a href='listCate.php'>请重新操作</a>";
        }
        return $mes;
    }else{
        alertMessage("不能删除该分类,请先删除该分类下的商品","listPro.php");
    }
}
/*
 * 得到所有的分类信息
 */
function getAllCate(){
    $sql="select * from shop_cate";
    $res=fetchAll($sql);
    return $res;
}