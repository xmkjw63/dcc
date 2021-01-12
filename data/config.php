<?php
//基本设置
date_default_timezone_set("Asia/Shanghai");

// 检查PHP版本
if(PHP_VERSION<5.3){
	die("PHP版本小于5.3，请升级！");
}
define("SiteURL","");
define("Multiuser","0");
define("Invite","0");
define("ViewAllData","0");
define("WeekDayStart","0");
// database
define("DB_HOST","localhost");
define("DB_USER","");
define("DB_PASS","");
define("DB_NAME","");
define("DB_PORT","");
define("TABLE","");