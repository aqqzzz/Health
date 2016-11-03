<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 活动操作的界面
 */
require_once "./common/user_session.php";
require_once "../config/smarty_init.php";
require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$username = get_username();
$activity_id = $_POST["id"];
$activity_op = $_POST["op"];
$db = new DB();
$response = "";
if($activity_op == 1) { // 参加活动
    join_ac($db, $username, $activity_id);
    $response = "参加成功";
} else if($activity_op == 2) {  // 退出活动
    out_ac($db, $username, $activity_id);
    $response = "退出成功";
} else {
    del_ac($db, $activity_id);
    $response = "删除成功";
}

//输出响应
echo $response;

function join_ac($db, $user_id, $ac_id) {
    $sql = "INSERT INTO user_activity VALUES ('$user_id', '$ac_id')";
    $db->execute_dml($sql);
    $sql = "UPDATE activity SET num = num + 1 WHERE id = '$ac_id'";
    $db->execute_dml($sql);
}

function out_ac($db, $user_id, $ac_id) {
    $sql = "DELETE FROM user_activity WHERE uid = '$user_id' AND aid = '$ac_id'";
    $db->execute_dml($sql);
    $sql = "UPDATE activity SET num = num - 1 WHERE id = '$ac_id'";
    $db->execute_dml($sql);
}

function del_ac($db, $ac_id) {
    $sql = "DELETE FROM user_activity WHERE aid = '$ac_id'";
    $db->execute_dml($sql);
    $sql = "DELETE FROM activity WHERE id = '$ac_id'";
    $db->execute_dml($sql);
}

?>
