<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 用户界面
 */
require_once "./common/user_session.php";
require_once "../config/smarty_init.php";
require_once "user_data.php";
require_once "./common/common.php";

$error = get_error();
$tpl->assign("error", $error);

$name = get_name();
$avatar = get_avatar();
$username = get_username();

$user_info = get_user_info($username);
$docid = $user_info["docid"];
$coaid = $user_info["coaid"];
$doc_name = get_nameById($docid);
$coa_name = get_nameById($coaid);
$sex = $user_info["sex"];
$goal = $user_info["goal"];
$identity = $user_info["identity"];
$motto = $user_info["motto"];

$my_moments = get_moments_by_id($username);

$tpl->assign("my_moments", $my_moments);
$tpl->assign("name", $name);
$tpl->assign("avatar", $avatar);
$tpl->assign("sex", $sex);
$tpl->assign("goal", $goal);
$tpl->assign("identity", $identity);
$tpl->assign("doc_name", $doc_name);
$tpl->assign("coa_name", $coa_name);
$tpl->assign("motto", $motto);
$tpl->display("user.html");

?>
