<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="111.php" method="post" enctype="multipart/form-data">
<!--在客户端设置文件最大大小,如果超过大小$_FILES的error会报错误2 -->
<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
请选择上传文件:<input type="file" name="myFile" multiple="multiple" accept="image/jpeg,image/gif,image/png,image/jpg"/><br/>
<input type="submit" value="上传" />
</form>
</body>
</html>
