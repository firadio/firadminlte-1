<?php

function safe_json_encode($value, $options = 0, $depth = 512, $fromCharset = 'GBK') {
    $encoded = json_encode($value, $options, $depth);
    if ($encoded === false && $value && json_last_error() == JSON_ERROR_UTF8) {
        $encoded = json_encode(utf8ize($value, $fromCharset), $options, $depth);
    }
    return $encoded;
}

function utf8ize($mixed, $fromCharset = 'GBK') {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", $fromCharset);
    }
    return $mixed;
}

function api($pdo) {
    $param = array();
    $param['reqjson'] = safe_json_encode($_REQUEST);
    $srvjson = array();
    $srvjson['ipaddress'] = get_client_ip();
    $srvjson['userjson'] = call_user_func(function () {
        if (!empty($_POST['userjson'])) return $_POST['userjson'];
        if (!empty($_GET['userjson'])) return $_GET['userjson'];
        if (!empty($_COOKIE['userjson'])) return $_COOKIE['userjson'];
    });
    $param['srvjson'] = safe_json_encode($srvjson);

    $func = keep_str(strtolower($_GET['func']), 'abcdefghijklmnopqrstuvwxyz_');
    if (empty($func)) {
        $json = array('errno' => -1, 'message' => 'empty func');
        return(safe_json_encode($json));
    }
    $json = $pdo->fetch('SELECT `' . $func . '`(:reqjson,:srvjson)', $param);
    $json = json_decode($json, true);
    if (is_array($json['setcookie'])) {
        foreach($json['setcookie'] as $k=>$v) {
            setcookie($k, $v, 2147483647, '/');
        }
        unset($json['setcookie']);
    }
    return(safe_json_encode($json));
}


