<?php
/**
 * @version: 2015-12-2
 * @author: cylong
 * 获得用户session
 */

session_start();

// 获得昵称
function get_name() {
    $name = "";
    if(isset($_SESSION["name"]) && !empty($_SESSION["name"])) {
    	// 读取SESSION
    	$name = $_SESSION["name"];
    } else {
        header("Location: login.php");
    }
    return $name;
}

// 获得头像路径
function get_avatar() {
    $avatar = "";
    if(isset($_SESSION["avatar"]) && !empty($_SESSION["avatar"])) {
        $avatar = $_SESSION["avatar"];
    } else {
        header("Location: login.php");
    }
    return $avatar;
}

// 获得用户名
function get_username() {
    $username = "";
    if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    	$username = $_SESSION["username"];
    } else {
        header("Location: login.php");
    }
    return $username;
}

?>
