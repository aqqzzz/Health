<?php
require_once "../config/db_config.php";
require_once "./class/DB.class.php";

// 接收用户名密码
$username = $_POST['username'];
$password = $_POST['password'];

$db = new DB();
$name = check_user($db, $username, $password);  // 验证用户登录，返回用户昵称
if($name) {
	header("Location: index.php");
	// 如果跳转，最好加上exit();
	exit();
} else {
    // 2代表用户名或者密码错误
	header("location: login.php?error=2");
}

function check_user($db, $username, $password) {
    $sql = "SELECT name, pass, avatar FROM user WHERE id = '$username'";
    $res = $db->execute_dql_arr($sql);
    if($res) {
		if($res[0]["pass"] != $password) {
			return "";
		}
        $name = $res[0]["name"];
        if(empty($name)) {      // 还未设置昵称
            $name = $username;  // 用登录id代替昵称
        }
		$avatar = $res[0]['avatar'];
		if(empty($avatar)) {
			$avatar = "images/default.jpg";	// 默认头像
		}
		// 保存session
		session_start();
		$_SESSION['username'] = $username;  // 登陆id
	    $_SESSION['name'] = $name;          // 昵称
		$_SESSION['avatar'] = $avatar;	// 头像
        return $name;
    }
    return "";
}
?>
