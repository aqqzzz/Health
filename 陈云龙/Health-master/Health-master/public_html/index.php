<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 首页面
 */
require_once "./common/user_session.php";
require_once "../config/smarty_init.php";
require_once "user_data.php";

$username = get_username();
$name = get_name();
$avatar = get_avatar();

$data_arr = get_today_data();
$total_run = get_total_run($username);
$todal_distance = $data_arr["goal"];

$iden = get_user_iden($username);

$my_user_btn = "";
$my_user_info = get_myuser_info($username); // 对医生或者教练有用

if($iden == 2 || $iden == 3) {   // 医生或者教练
    $my_user_btn .= "<li role=\"presentation\"><a href=\"#my_user\" data-toggle=\"tab\">我的用户</a></li>";
}

$advice_from_doc = get_advice_from_doc($username);  // 来自医生的建议
$advice_from_coa = get_advice_from_coa($username);  // 来自教练的建议
$all_moments = get_allmoments();    // 全部动态
$user_orgerby_time = get_user_orderby("run_time", 5);
$user_orgerby_distance = get_user_orderby("run_distance", 5);
$user_time_rank = get_user_rank($username, "run_time", 1000);
$user_distance_rank = get_user_rank($username, "run_distance", 1000);

$tpl->assign("user_distance_rank", $user_distance_rank);
$tpl->assign("user_time_rank", $user_time_rank);
$tpl->assign("user_orgerby_time", $user_orgerby_time);
$tpl->assign("user_orgerby_distance", $user_orgerby_distance);
$tpl->assign("advice_from_doc", $advice_from_doc);
$tpl->assign("advice_from_coa", $advice_from_coa);
$tpl->assign("all_moments", $all_moments);
$tpl->assign("my_user_info", $my_user_info);
$tpl->assign("my_user_btn", $my_user_btn);
$tpl->assign("name", $name);
$tpl->assign("username", $username);
$tpl->assign("avatar", $avatar);
$tpl->assign("data_arr", $data_arr);
$tpl->assign("total_run", $total_run);

$tpl->display("index.html");
?>
