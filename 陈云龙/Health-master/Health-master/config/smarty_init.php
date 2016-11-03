<?php
/**
 * @version: 2015-12-1
 * @author: cylong
 * smarty的配置
 */
define('SMARTY_ROOT','../public_html/tpls');
include_once("../smarty/Smarty.class.php");

$tpl = new Smarty();
$tpl->template_dir = SMARTY_ROOT."/templates/";
$tpl->compile_dir = SMARTY_ROOT."/templates_c/";
$tpl->config_dir = SMARTY_ROOT."/configs/";
$tpl->cache_dir = SMARTY_ROOT."/cache/";
$tpl->caching=0;
$tpl->auto_literal = false;
$tpl->cache_lifetime = 60 * 60 * 24;
$tpl->left_delimiter = '<{'; // 修改默认定界符
$tpl->right_delimiter = '}>';
?>