<?php
/**
 * @version: 2015-12-5
 * @author: cylong
 * 删除动态
 */

require_once "../config/db_config.php";
require_once "./class/DB.class.php";

$m_id = $_POST["m_id"];

$db = new DB();
$sql = "DELETE FROM moments WHERE id = '$m_id'";
$db->execute_dml($sql);

$response = "删除成功";
echo $response;

?>
