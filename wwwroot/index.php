<?php

define('DS', DIRECTORY_SEPARATOR);
include __DIR__ . DS . 'config.php';
header("Content-type: text/html; charset=utf-8");
$path = $_SERVER['PATH_INFO'];
$i = strrpos($path, '.');
if ($i !== FALSE) {
    // 如果存在扩展名，就去掉
    $path = substr($path, 0, $i);
}
// 安全过滤
$path = str_replace('.', '', $path);
$path = str_replace('\\', '/', $path);
$path = trim($path, '/');
$paths = explode('/', $path);
// 取根文件名
$filename = $paths[0];
if ($filename === '') {
    $filename = 'index';
}
// 加上扩展名
$filename .= '.php';
// $pagedir = dirname(__DIR__) . DS . 'page';
$pagedir = __DIR__ . DS . 'source' . DS . 'page';
$file = $pagedir . DS . $filename;
if (is_file($file)) {
    include $file;
    exit;
}
?>
欢迎访问
<?php
echo $_SERVER['REMOTE_ADDR'];
