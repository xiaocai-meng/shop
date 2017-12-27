<?php
//data()把时间调整到北京时间，php5默认为格林威治标准时间
date_default_timezone_set('PRC');
require_once '../include.php';
checkLogin();
@$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName like '%{$keywords}%'":null;
@$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from shop_pro as p join shop_cate as c on p.cId=c.id {$where}";
$totalRows=getResultNum($sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$offset=($page-1)*$pageSize;
$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from shop_pro as p join shop_cate as c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
if(!$rows){
    alertMessage("没有商品,请添加",'addPro.php');
    exit;
}
//print_r($rows);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="css/backstage.css">
    <link rel="stylesheet" href="js/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css"/>
    <script src="js/jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail" style="display:none;">

</div>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
        </div>
        <div class="fr">
            <div class="text">
                <span>商品价格：</span>
                <div class="bui_select">
                    <select name="" id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="iPrice asc">由低到高</option>
                        <option value="iPrice desc">由高到低</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>上架时间：</span>
                <div class="bui_select">
                    <select name="" id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="pubTime desc">最新发布</option>
                        <option value="pubTime asc">历史发布</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>搜索</span>
                <input type="text" value="<?php echo $keywords; ?>" class="search" id="search" onkeypress="search(event)" />
            </div>
        </div>
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="20%">商品名称</th>
            <th width="10%">商品分类</th>
            <th width="5%">是否上架</th>
            <th width="15%">上架时间</th>
            <th width="10%">价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1;foreach ($rows as $row): ?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check" value=<?php echo $row['id']; ?>><label for="c1" class="label"><?php echo $row['id']; ?></label></td>
                <td><?php echo $row['pName']; ?></td>
                <td><?php echo $row['cName']; ?></td>
                <td>
                    <?php
                    $show = ($row['isShow'] == 1) ? "上架" : "下架";
                    echo $show;
                    ?>
                </td>
                <td><?php echo date("Y-m-d H:i:s a",$row['pubTime']);?></td>
                <td><?php echo $row['iPrice']; ?>元</td>
                <td align="center">
                    <input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id']; ?>,'<?php echo $row['pName']; ?>')" />
                    <input type="button" value="修改" class="btn" onclick="editPro(<?php echo $row['id']; ?>)" />
                    <input type="button" value="删除" class="btn" onclick="deletePro(<?php echo $row['id']; ?>)" />
                    <div id="showDetail<?php echo $row['id']; ?>" style="display:none;">
                        <table class="table" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="20%" align="right">商品名称</td>
                                <td><?php echo $row['pName']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">商品类别</td>
                                <td><?php echo $row['cName']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">商品货号</td>
                                <td><?php echo $row['pSn']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">商品数量</td>
                                <td><?php echo $row['pNum']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">商品价格</td>
                                <td><?php echo $row['mPrice']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">价格</td>
                                <td><?php echo $row['iPrice']; ?></td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">商品图片</td>
                                <td>
                                <?php
                                $proImg=getAllImgByProId($row['id']);
                                //print_r($proImg);
                                if($proImg): {
                                    foreach ($proImg as $img):
                                ?>
                                    <img width="100" height="100" src="uploads/<?php echo $img['albumPath']; ?>" alt="">&nbsp;&nbsp;
                                <?php endforeach; }?>
                                <?php else: ?><p>没有图片</p>
                                <?php endif;?>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">是否上架</td>
                                <td>
                                    <?php
                                    $show = ($row['isShow'] == 1) ? "上架" : "下架";
                                    echo $show;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%" align="right">是否热卖</td>
                                <td>
                                    <?php
                                    $hot = ($row['isHot'] == 1) ? "热卖" : "促销";
                                    echo $hot;
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <span style="display:block;width:80%; ">商品描述<br/><?php echo $row['pDesc']; ?></span>
                    </div>

                </td>
            </tr>
            <?php $i++;endforeach; ?>
            <?php if ($totalRows > $pageSize): ?>
                <tr>
                    <td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}"); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    //jq-ui dialog弹出层
    function showDetail(id, t) {
        $("#showDetail" + id).dialog({
            height: "auto",  //高度，默认 'auto'
            width: "auto", //宽度, 默认 300
            position: {my: "center", at: "center", collision: "fit"}, //弹出框的位置
            modal: false,//是否模式对话框
            draggable: true,//是否允许拖动，默认为 true
            resizable: true,//是否可以调整对话框的大小，默认为 true
            title: "商品名称：" + t,//对话框的标题，可以是 html 串，例如一个超级链接。
            show: "slide",   //当对话框打开时的效果。默认为 null
            hide: "explode" //当对话框关闭时的效果，默认为 null, 例如， hide: 'slide'
        });
    }
    function addPro() {
        window.location = 'addPro.php';
    }
    function editPro(id){
        window.location="editPro.php?id="+id;
    }
    function deletePro(id){
        if(window.confirm("您确定要删除吗?删除之后不可恢复!")) {
            window.location = "doAdminAction.php?act=deletePro&id=" + id;
        }
    }
    function search(e){
        //keyCode:IE支持，which:FF支持,window.event Ie支持 e火狐支持
        //这句相当于if(!window.event)var theEvent =e;就是||前面的为false表达式就等于||后面的
        var theEvent=window.event||e;
        var code=theEvent.keyCode||theEvent.which;
        //event.keyCode 取回被按下的字符 13表示回车
        if(code==13){
            var val=document.getElementById("search").value;
            window.location="listPro.php?keywords="+val;
        }
    }
    function change(val){
        //alert(1);
        window.location="listPro.php?order="+val;
    }
</script>
</body>
</html>