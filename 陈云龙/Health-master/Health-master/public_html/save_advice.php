<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 保存教练或者医生建议
 */
require_once "./common/user_session.php";
require_once "user_data.php";

$uid = $_POST["uid"];
$info = $_POST["info"];
$username = get_username();
if(!empty($info)) {
    save_advice($username, $uid, $info);
}

function save_advice($username, $uid, $info) {
    global $db;
    $sql = "";
    $iden = get_user_iden($username);
    if($iden == 2) {        // 医生
        $sql = "INSERT INTO d_feed_back(uid, docid, info) VALUES ('$uid', '$username', '$info')";
    } else if($iden == 3) { // 教练
        $sql = "INSERT INTO c_feed_back(uid, coaid, info) VALUES ('$uid', '$username', '$info')";
    }
    $db->execute_dml($sql);
}
$response = "发送成功";
echo $response;

?>
