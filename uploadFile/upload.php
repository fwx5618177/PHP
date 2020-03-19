<?php

if($_FILES['file']['error']) {
    $status = $_FILES['file']['error'];
    switch ($status) {

        case 1:
            $str = '上传的文件超过了php.ini种upload_max_filesize选项限制的值';
            break;
        case 2:
            $str = '上传的文件大小超过了html表单MAX_FILE_SIZE选项指定的值';
            break;
        case 3:
            $str = '文件只有部分被上传';
            break;
        case 4:
            $str = '没有文件被上传';
            break;
        case 5:
            $str = '找不到临时文件夹5';
            break;
        case 6:
            $str = '找不到临时文件夹6';
            break;
        case 7:
            $str = '文件写入失败';
            break;
        default:
            $str = '上传文件成功';
        break;
        
    }

    echo $str;
    exit;
}


$_FILES['file']['size'] > (pow(1024, 2)*2 ) ? exit('文件大小超过了准许的大小') : var_dump('文件正常，正在上传');

$allowMime = ['image/png', 'image/jpeg', 'image/gif', 'image/wbmp'];
$allowFix = ['png', 'jpeg', 'gif', 'wbmp', 'jpg'];

$info = pathinfo($_FILES['file']['name']) or die('没有任何文件信息');
$subFix = $info['extension'];

(!in_array($subFix, $allowFix))? exit('不被允许的文件后缀'): var_dump('文件检查通过');

(!in_array($_FILES['file']['type'], $allowMime)) ? exit('不被允许的MIME类型'): var_dump('文件类型检查通过');

$filePath = 'upload';

(!file_exists($filePath)) ? mkdir($filePath):var_dump('文件正在上传');

$fileName = uniqid() . '.' . $subFix;

is_uploaded_file($_FILES['file']['tmp_name']) ? move_uploaded_file($_FILES['file']['tmp_name'], "./" . $filePath . "/" .$fileName) ? var_dump ('上传成功'): var_dump ('文件移动失败') : var_dump ("未上传文件");



?>