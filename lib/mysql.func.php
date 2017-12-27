<?php
/*
 * 数据库操作
 */

//插入
function insert($table, $array)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }
    //    else {
    //        printf("Current character set: %s\n", mysqli_character_set_name($link));
    //    }

    $keys = join(",", array_keys($array));
    $values = "'" . join("','", array_values($array)) . "'";
    $sql = "insert into {$table}($keys) values({$values})";
    //echo $sql;
    $mes = mysqli_query($link, $sql);
    //mysqli_insert_id() 函数返回最后一个查询中自动生成的 ID（通过 AUTO_INCREMENT 生成）。
    $res = mysqli_insert_id($link);
    //print_r($res);
    mysqli_close($link);
    if ($mes === false) {
        return false;
    } else {
        return $res;
    }

}

//更新
function update($table, $array, $where = null)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }

    $str = null;
    foreach ($array as $key => $val) {
        if ($str == null) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
    $sql = "update {$table} set {$str}" . ($where == null ? null : "where " . $where);
    $mes = mysqli_query($link, $sql);
    //mysqli_affected_rows() 函数返回前一次 MySQL 操作（SELECT、INSERT、UPDATE、REPLACE、DELETE）所影响的记录行数。
    $res = mysqli_affected_rows($link);
    //echo $res;
    mysqli_close($link);
    if ($mes === false) {
        return false;
    } else {
        return $res;
    }
}

//删除
function delete($table, $where = null)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }

    $where = $where == null ? null : "where " . $where;
    $sql = "delete from {$table} {$where}";
    $mes = mysqli_query($link, $sql);
    $res = mysqli_affected_rows($link);
    mysqli_close($link);
    if ($mes === false) {
        return false;
    } else {
        return $res;
    }
}

//查找一条数据
function fetchOne($sql, $result_type = MYSQLI_ASSOC)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }

    $result = mysqli_query($link, $sql);
    //mysqli_fetch_array() 函数从结果集中取得一行作为关联数组，或数字数组，或二者兼有。
    $row = mysqli_fetch_array($result, $result_type);
    mysqli_close($link);
    return $row;
}

//查找所有数据
function fetchAll($sql, $result_type = MYSQLI_ASSOC)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }

    $result = mysqli_query($link, $sql);

    //@符号阻止警告输出
    while (@$row = mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    mysqli_close($link);
    return @$rows;
}

//获得数据的条数
function getResultNum($sql)
{
    $link = mysqli_connect("localhost", "root", "root", "shop");

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    /* change character set to utf8 */
    if (!mysqli_set_charset($link, "utf8")) {
        printf("Error loading character set utf8: %s\n", mysqli_error($link));
    }

    $result = mysqli_query($link, $sql);
    //mysqli_num_rows() 函数返回结果集中行的数量。
    $res = mysqli_num_rows($result);
    mysqli_close($link);
    return $res;
}

