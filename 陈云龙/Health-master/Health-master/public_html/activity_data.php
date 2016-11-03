<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 读取activity数据
 */
require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$db = new DB();

// 全部未过期活动
function get_activity_list() {
    global $db;
    $sql = "SELECT * FROM activity WHERE a_time > datetime('now', 'localtime') ORDER BY a_time ASC";
    $activity_list = $db->execute_dql_arr($sql);
    return $activity_list;
}

function get_history_list() {
    global $db;
    $sql = "SELECT * FROM activity WHERE a_time <= datetime('now', 'localtime') ORDER BY a_time ASC";
    $history_act = $db->execute_dql_arr($sql);
    return $history_act;
}

// id用户参加的活动
function get_activity_by_id($id) {
    global $db;
    $sql = "SELECT DISTINCT * FROM user_activity, activity WHERE activity.id = user_activity.aid AND user_activity.uid = '$id' ORDER BY activity.a_time ASC";
    $activity_list = $db->execute_dql_arr($sql);
    return $activity_list;
}

?>
