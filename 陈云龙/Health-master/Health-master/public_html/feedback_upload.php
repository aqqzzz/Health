<?php

require_once "save_advice.php";

$uid = $_POST["uid"];
if ($_FILES["file"]["error"] > 0) {
	echo "error!" . $_FILES["file"]["error"] . "<br />";
}
else {
	echo "文件名: " . $_FILES["file"]["name"] . "<br />";
	echo "类型: " . $_FILES["file"]["type"] . "<br />";
	echo "大小: " . ($_FILES["file"]["size"] / 1024) . " KB<br />";
	echo "存储位置:" . $_FILES["file"]["tmp_name"] ;
	$name = $_FILES["file"]["name"];
	$name = iconv("GB2312" ,"UTF-8", $name);
    echo "data/" . $_FILES["file"]["name"];
	move_uploaded_file($_FILES["file"]["tmp_name"], "data/" . $name);
	$new_name = "data/" . $_FILES["file"]["name"];

    $handle = fopen ($new_name, 'r' );
	$content = '';
	while (!feof($handle)) {
		$content .= fread($handle, 8080);
	}

    save_advice($username, $uid, $content);
}
?>
