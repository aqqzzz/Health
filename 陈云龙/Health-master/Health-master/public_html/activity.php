<?php
/**
 * @version: 2015-12-2
 * @author: cylong
 * 活动管理界面
 */
require_once "./common/user_session.php";
require_once "user_data.php";
require_once "../config/smarty_init.php";
require_once "./common/common.php";
require_once "activity_data.php";

$username = get_username();
$name = get_name();
$avatar = get_avatar();

$tpl->assign("name", $name);
$tpl->assign("avatar", $avatar);

$error = get_error();
$tpl->assign("error", $error);

// 判断是否是管理员
$identity = get_user_iden($username);
$add_activity = "";
$form_activity = "";
$isAdmin = ($identity == 0);
if($isAdmin) {  // 是管理员
    $add_activity .= "<li role=\"presentation\"><a href=\"#add\" data-toggle=\"tab\">活动发布</a></li>";
    $form_activity .= "<form action=\"activity_add.php\" method=\"post\">";
    $form_activity .= "<table class=\"add_activity\">";
    $form_activity .= "<tr>";
    $form_activity .= "<td class=\"first_col\">标题</td>";
    $form_activity .= "<td><input id=\"add_title\" name=\"title\" type=\"text\"/><span id=\"title_error\" class=\"error\">请输入标题</span></td>";
    $form_activity .= "</tr>";
    $form_activity .= "<tr>";
    $form_activity .= "<td class=\"first_col\">时间</td>";
    $form_activity .= "<td><input id=\"time\" name=\"time\" type=\"text\"/><span id=\"time_error\" class=\"error\">请输入时间</span></td>";
    $form_activity .= "</tr>";
    $form_activity .= "<tr>";
    $form_activity .= "<td class=\"first_col\">地点</td>";
    $form_activity .= "<td><input id=\"place\" name=\"place\" type=\"text\"/><span id=\"place_error\" class=\"error\">请输入地点</span></td>";
    $form_activity .= "</tr>";
    $form_activity .= "<tr>";
    $form_activity .= "<td class=\"first_col\" valign=\"top\">详细描述</td>";
    $form_activity .= "<td><textarea name=\"info\"></textarea></td>";
    $form_activity .= "</tr>";
    $form_activity .= "<tr>";
    $form_activity .= "<td class=\"first_col\"></td>";
    $form_activity .= "<td>";
    $form_activity .= "<input class=\"button pink\" type=\"submit\" onclick=\"return check_input()\" value=\"发布\" />";
    $form_activity .= "</td>";
    $form_activity .= "</tr>";
    $form_activity .= "</table>";
    $form_activity .= "</form>";
}

// 全部活动
$activity_list = get_activity_list();
// 历史活动活动
$history_act = get_history_list();

// 用户参与的活动
$user_activity = get_activity_by_id($username);
$activity_list = join_sign($activity_list, $user_activity);  // 标记用户参与的活动

function join_sign($activity_list, $user_activity) {
    $len_all = count($activity_list);
    $len_my = count($user_activity);
    for ($i = 0; $i < $len_all; $i++) {
        $activity_list[$i]["sign"] = 0;     // 未参加
        for ($j = 0; $j < $len_my; $j++) {
            $ac_all = $activity_list[$i];
            $ac_my = $user_activity[$j];
            if($ac_all["id"] == $ac_my["id"]) {
                $activity_list[$i]["sign"] = 1;     // 用户参与了这个活动
            }
        }
    }
    return $activity_list;
}

$tpl->assign("identity", $identity);
$tpl->assign("add_activity", $add_activity);
$tpl->assign("form_activity", $form_activity);
$tpl->assign("user_activity", $user_activity);
$tpl->assign("history_act", $history_act);
$tpl->assign("activity_list", $activity_list);
$tpl->display("activity.html");
?>
