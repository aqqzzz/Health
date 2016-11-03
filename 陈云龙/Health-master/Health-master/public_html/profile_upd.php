<?php
/**
 * @version: 2015-12-2
 * @author: cylong
 * 用户基本信息修改
 */
require_once "user_data.php";
require_once "./common/user_session.php";
require_once "../config/smarty_init.php";

$username = get_username();
$name = $_POST["name"];
$gender = $_POST["gender"];
$goal = $_POST["goal"];
$identity = $_POST["identity"];
$motto = $_POST["motto"];

$doctor = $_POST["doctor"];
$coach = $_POST["coach"];
$docid = get_id_by_name($doctor);
$coaid = get_id_by_name($coach);
$iden_doc = get_user_iden($docid);
$iden_coa = get_user_iden($coaid);
if($iden_doc != 2) {
    $docid = "";
}
if($iden_coa != 3) {
    $coaid = "";
}

$db = new DB();
$bool = check_name($db, $name);     // 检查用户昵称是否重复
if($bool) {
    header("Location: user.php?error=1");   // 1代表用户名重复
	exit();
} else {
    $sql = "UPDATE user SET name='$name', sex='$gender', goal='$goal', identity='$identity', motto='$motto', docid='$docid', coaid='$coaid' WHERE id = '$username'";
    $db->execute_dml($sql);
    $_SESSION["name"] = $name;
    header("Location: user.php?error=2");   // 2代表修改成功
	exit();
}

function check_name($db, $name) {
    $sql = "SELECT * FROM user WHERE name='$name'";
    $res = $db->execute_dql_arr($sql);
    if($res) {
        $cur_name = get_name();
        if($cur_name == $res[0]["name"]) {  // 就是用户当前的名字
            return false;
        }
        return true;
    }
    return false;
}
?>
