<?php
require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$username = $_POST["username"];
$password = $_POST["password"];
$pass_confirm = $_POST["pass_confirm"];

$db = new DB();
$bool = check($db, $username);   // 检查用户名是否重复
if($bool) {
    // 1代表用户名重复
    header("location: register.php?error=1");
    exit();
} else {
    // 保存session
    session_start();
    $_SESSION['username'] = $username;  // 注册id
    $_SESSION['name'] = $username;      // 昵称用注册账号代替
    $_SESSION['avatar'] = "images/default.jpg";      // 默认头像
    insertIntoDB($db, $username, $password);
    header("location: index.php");
}

// 检查用户名是否重复
function check($db, $username) {
    $sql = "SELECT * FROM user WHERE id = '$username'";
    $res = $db->execute_dql_arr($sql);
    if($res) {
        return true;
    }
    return false;
}

function insertIntoDB($db, $username, $password) {
    $sql = "INSERT INTO user (id, pass) VALUES ('$username', '$password')";
    $db->execute_dml($sql);
}
?>
