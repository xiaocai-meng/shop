<?php
function addAlbum($array){
    insert('shop_album',$array);
}
/*
 * 根据商品id得到一张商品图片
 */
function getProImgById($id){
    $sql="select * from shop_album where pid={$id} limit 1";
    $row=fetchOne($sql);
    return $row;
}
/*
 * 根据商品id得到所有商品图片
 */
function getProImgsById($id){
    $sql="select * from shop_album where pid={$id}";
    $rows=fetchAll($sql);
    return $rows;
}
/*
 * 添加文字水印
 */
function doWaterText($id){
    $rows=getProImgsById($id);
    foreach($rows as $row){
        $filename="../image_800/".$row['albumPath'];
        waterText($filename);
    }
    $mes="操作成功";
    return $mes;
}
/*
 * 添加图片水印
 */
function doWaterPic($id){
    $rows=getProImgsById($id);
    foreach($rows as $row){
        $filename="../image_800/".$row['albumPath'];
        waterPic($filename);
    }
    $mes="操作成功";
    return $mes;
}

