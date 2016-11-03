<?php

/**
 * 通用的方法
 * @version: 2015-12-05
 * @author: cylong
 */

function get_error() {
	$error = 0; // 正常
	// 接收错误编号
	if(!empty($_GET['error'])) {
	 $error = $_GET['error'];
	}
	return $error;
}
?>
