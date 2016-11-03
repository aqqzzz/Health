<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 竞赛界面
 */
require_once "./common/user_session.php";
require_once "../config/smarty_init.php";

$name = get_name();
$avatar = get_avatar();

$tpl->assign("name", $name);
$tpl->assign("avatar", $avatar);
$tpl->display("race.html");

?>
