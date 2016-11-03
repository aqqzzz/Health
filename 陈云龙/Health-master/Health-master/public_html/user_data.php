<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 用户数据界面
 */

require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$db = new DB();

// 获得今天的用户数据，应该根据user_id获得，此时所有用户通用一个文件
function get_today_data() {
    $file_name = "./data/user_health.xml";
    $data_arr = array();
    if(file_exists($file_name)){
        $xml_array = simplexml_load_file($file_name);
        foreach($xml_array as $tmp){    // 只取一条数据
            $h = $data_arr["height"] = $tmp->height;
            $w = $data_arr["weight"] = $tmp->weight;
            $data_arr["bmi"] = number_format($w * 1.0 / ($h * $h / 10000), 2, '.', '');
            $data_arr["hr"] = $tmp->hr;
            $data_arr["bph"] = $tmp->bph;
            $data_arr["bpl"] = $tmp->bpl;
            $data_arr["goal"] = $tmp->goal;
        	break;
        }
    }
    return $data_arr;
}

// 获得用户最近的数据
function get_recent_data($day) {
    $file_name = "./data/user_health.xml";
    $recent_arr = array();
    if(file_exists($file_name)){
        $xml_array = simplexml_load_file($file_name);
        $i = 0;
        foreach($xml_array as $tmp){    // 只取一条数据
            $h = $recent_arr["height"][$i] = $tmp->height;
            $w = $recent_arr["weight"][$i] = $tmp->weight;
            $recent_arr["bmi"][$i] = number_format($w * 1.0 / ($h * $h / 10000), 2, '.', '');
            $recent_arr["hr"][$i] = $tmp->hr;
            $recent_arr["bph"][$i] = $tmp->bph;
            $recent_arr["bpl"][$i] = $tmp->bpl;
            $recent_arr["goal"][$i] = $tmp->goal;
            $i++;
            if($i >= $day) {
                break;
            }
        }
    }
    return $data_arr;
}

// 获得该医生或者教练的监督用户
function get_myuser_info($id) {
    global $db;
    $sql = "SELECT * FROM user WHERE docid = '$id' OR coaid = '$id'";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

// 包涵总距离和总时间的数组
function get_total_run($id) {
    global $db;
    $sql = "SELECT run_time, run_distance FROM user WHERE id = '$id'";
    $res = $db->execute_dql_arr($sql);
    $total_run["time"] = $res[0]["run_time"];
    $total_run["distance"] = $res[0]["run_distance"];
    return $total_run;
}

// 获得用户身份
function get_user_iden($id) {
    global $db;
    $sql = "SELECT identity FROM user WHERE id = '$id'";
    $res_iden = $db->execute_dql_arr($sql);
    $identity = $res_iden[0]["identity"];
    return $identity;
}

// 获得医生建议
function get_advice_from_doc($id) {
    global $db;
    $sql = "SELECT d.id cid, u.id uid, * FROM d_feed_back d, user u WHERE d.uid = '$id' AND d.docid = u.id ORDER BY d.fbdate DESC";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

// 获得教练建议
function get_advice_from_coa($id) {
    global $db;
    $sql = "SELECT c.id cid, u.id uid, * FROM c_feed_back c, user u WHERE c.uid = '$id' AND c.coaid = u.id ORDER BY c.fbdate DESC";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

// 全部的动态
function get_allmoments() {
    global $db;
    $sql = "SELECT m.id mid, u.id uid, * FROM moments m, user u WHERE m.uid = u.id ORDER BY m.mdate DESC";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

function get_moments_by_id($id) {
    global $db;
    $sql = "SELECT m.id mid, u.id uid, * FROM moments m, user u WHERE m.uid = u.id AND m.uid = '$id' ORDER BY m.mdate DESC";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

// 通过id查找name
function get_nameById($id) {
    global $db;
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $res = $db->execute_dql_arr($sql);
    if($res) {
        $name = $res[0]["name"];
        if(empty($name)) {
            $name = $res[0]["id"];
        }
        return $name;
    } else {
        return "无";
    }
}

// 通过name查找id
function get_id_by_name($name) {
    global $db;
    $sql = "SELECT * FROM user WHERE name = '$name'";
    $res = $db->execute_dql_arr($sql);
    if($res) {
        $id = $res[0]["id"];
        return $id;
    } else {
        return "";
    }
}

function get_user_info($id) {
    global $db;
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $res = $db->execute_dql_arr($sql);
    return $res[0];
}

function get_user_orderby($key, $max) {
    global $db;
    $sql = "SELECT * FROM user ORDER BY $key DESC LIMIT 0, $max";
    $res = $db->execute_dql_arr($sql);
    return $res;
}

function get_user_rank($username, $key, $max) {
    $arr = get_user_orderby($key, $max);
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        if($username == $arr[$i]["id"]) {
            return $i + 1;
        }
    }
    return 999;
}
?>
