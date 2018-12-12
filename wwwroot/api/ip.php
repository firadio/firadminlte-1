<?php

function get_client_ip() {
	return keep_str(get_real_ip(), '0123456789ABCDEFabcdef:.');
}
function keep_str($str, $keep = '0123456789ABCDEFabcdef:.') {
	$out = '';
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++) {
		$s = $str[$i];
		if (strpos($keep, $s) === false) {
			continue;
		}
		$out .= $s;
	}
	return $out;
}
function get_real_ip() {
	if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
		return $_SERVER['HTTP_X_REAL_IP'];
	}
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos = array_search('unknown', $arr);
		if (false !== $pos) unset($arr[$pos]);
		return trim($arr[0]);
	}
	return $_SERVER['REMOTE_ADDR'];
}
