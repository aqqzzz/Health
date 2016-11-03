<?php
require_once "../config/smarty_init.php";
require_once "./common/common.php";

$error = get_error();
$tpl->assign("error", $error);

$tpl->display("login.html");

?>
