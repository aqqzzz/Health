<?php
/**
 * @version: 2015-12-4
 * @author: cylong
 * 添加活动
 */

require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$title = $_POST["title"];
$time = $_POST["time"];
$place = $_POST["place"];
$info = $_POST["info"];

$db = new DB();
$sql = "INSERT INTO activity(title, a_time, place, info) VALUES ('$title', '$time', '$place', '$info')";
$db->execute_dml($sql);
header("Location: activity.php?error=2");
?>
