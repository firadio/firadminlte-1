<?php

header("Content-type: text/html; charset=utf-8");
define('DS', DIRECTORY_SEPARATOR);
// include dirname(__DIR__) . DS . 'config.php';
include (__DIR__) . DS . 'func.php';
include (__DIR__) . DS . 'ip.php';
include (__DIR__) . DS . 'MyPDO.php';

$pdo = new MyPDO('vps.firadio.net', 3324, 'feieryun', 'feieryun', 'firadio_ucenter');
exit(api($pdo));

