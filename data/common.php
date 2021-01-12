<?php
error_reporting(0);
define('IN_CRONLITE', true);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
define('SYS_KEY', 'DaenCreativeCloud');
require 'config.php';
include_once("db.class.php");
include_once("function.php");
date_default_timezone_set("PRC");
$password_hash='!@#%!s!0';
$date = date("Y-m-d H:i:s");

ob_start();
if (session_status() !==PHP_SESSION_ACTIVE) {
        session_start();
}

//连接数据库
$DB=new DB(DB_HOST,DB_USER,DB_PASS,DB_NAME,DB_PORT);
$rs=$DB->query("select * from ".constant("TABLE")."system where id = '1'");
$res = $DB->fetch($rs);
$system=array(//系统变量
	'title' => $res['title'], //网站SEO：标题
	'keywords' => $res['keywords'],//网站SEO：关键词
	'description' => $res['description'], //网站SEO：说明
	'admin_name' => $res['admin_name'], //管理员名字
	'admin_qq' => $res['admin_qq'], //管理员QQ
	'status' => $res['status'], //网站状态，是否可用?1:0
	'user_status' => $res['user_status'], //用户注册开关，是否可注册?1:0
	'info_status' => $res['info_status'], //应用不可用提示内容
	'info_needlogin' => $res['info_needlogin'],//需要登录提示内容
	'index_status' => $res['index_status'], //首页是否弹窗?1:0
	'index_content' => $res['index_content'], //首页弹窗内容
	'msg_status' => $res['msg_status'], //用户留言开关，是否可留言?1:0
	'msg_open' => $res['msg_open'],//用户留言展示，是否展示?1:0
	'link1' => $res['link1'], //友情链接
	'link2' => $res['link2'], //友情链接
	'link3' => $res['link3'], //友情链接
	'link4' => $res['link4'],//友情链接
	'copyright' => $res['copyright'],//版权
	'webdata' => $res['webdata'],//统计代码
	'sign_vid' => $res['sign_vid'],//vaptcha
	'sign_key' => $res['sign_key']//vaptcha
);
$info=array(//提示消息内容
	'plugin_info' => str_replace(array("\r\n", "\r", "\n"), "<br>", $system['info_status']),//应用不可用提示内容
	'login_info' => str_replace(array("\r\n", "\r", "\n"), "<br>", $system['info_needlogin']),//需要登录提示内容
	'index_info' => str_replace(array("\r\n", "\r", "\n"), "<br>", $system['index_content'])//首页弹窗内容
);
$link=array(//友情链接，二维数组 名字 URL \n 名字 URL ……
	explode(" ",$system['link1']),
	explode(" ",$system['link2']),
	explode(" ",$system['link3']),
	explode(" ",$system['link4'])
);
?>