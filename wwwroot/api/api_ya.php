<?php

header("Content-type: text/html; charset=utf-8");
define('DS', DIRECTORY_SEPARATOR);
// include dirname(__DIR__) . DS . 'config.php';
include (__DIR__) . DS . 'func.php';
include (__DIR__) . DS . 'ip.php';
include (__DIR__) . DS . 'MyPDO.php';

$pdo = new MyPDO('172.16.151.199', 3306, 'feieryun', 'feieryun', 'firadio_yun_agent');
exit(api($pdo));

