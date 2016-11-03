<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * 发布动态
 */
require_once "./common/user_session.php";
require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$username = get_username();
$info = $_POST["info"];

$db = new DB();
$sql = "INSERT INTO moments(uid, content) VALUES ('$username', '$info')";
$db->execute_dml($sql);
$response = "发布成功";
echo $response;
?>
