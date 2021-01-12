<?php
error_reporting(E_ALL & ~E_NOTICE);  //显示全部错误
define('ROOT_PATH', dirname(dirname(__FILE__)));  //定义根目录
define('DBCHARSET','UTF8');   //设置数据库默认编码
if(function_exists('date_default_timezone_set')){
	date_default_timezone_set('Asia/Shanghai');
}
input($_GET);
input($_POST);
function input(&$data){
	foreach ((array)$data as $key => $value) {
		if(is_string($value)){
			if(!get_magic_quotes_gpc()){
				$value = htmlentities($value, ENT_NOQUOTES);
                $value = addslashes(trim($value));
			}
		}else{
			$data[$key] = input($value);
		}
	}
}
//判断是否安装过程序
if(is_file('lock') && $_GET['step'] != 5){
	@header("Content-type: text/html; charset=UTF-8");
    echo "系统已经安装过了，如果要重新安装，那么请删除install目录下的lock文件";
    exit;
}

$html_title = 'Daen创意云 - 安装';
$html_header = <<<EOF
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">
       
      <!-- logo -->
      <div id="logo" class="sidebar-header">
        <a href="index.html"><img src="../assets/images/logo-sidebar.png" title="LightYear" alt="LightYear" /></a>
      </div>
      <div class="lyear-layout-sidebar-scroll">
        
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
            <li class="nav-item active"> <a href="#"><i class="mdi mdi-home"></i> 安装</a> </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="mdi mdi-palette"></i> 项目</a>
              <ul class="nav nav-subnav">
                <li> <a href="https://gitee.com/daenmax/" target="_blank">Github</a> </li>
                <li> <a href="https://gitee.com/daenmax/DaenCreativeCloud" target="_blank">Gitee</a> </li>
                <li> <a href="https://www.daenx.cn" target="_blank">Daen</a> </li>
              </ul>
            </li>
          </ul>
        </nav>
        
        <div class="sidebar-footer">
          <p class="copyright">Copyright &copy; 2020. <a target="_blank" href="http://daenx.cn">Daen</a> All rights reserved.</p>
        </div>
      </div>
      
    </aside>
    <!--End 左侧导航-->
    
    <!--头部信息-->
    <header class="lyear-layout-header">
      
      <nav class="navbar navbar-default">
        <div class="topbar">
          
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"> 安装 </span>
          </div>
          
          
          
        </div>
      </nav>
      
    </header>
    <!--End 头部信息-->
	<!--页面主要内容-->
    <main class="lyear-layout-content">
EOF;

$html_footer2 = <<<EOF
</main>
    <!--End 页面主要内容-->
	  </div>
</div>
<!--消息提示-->
<script src="../assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="../assets/js/lightyear.js"></script>
<script type="text/javascript" src="../assets/js/main.min.js"></script>

EOF;
$html_footer = <<<EOF
</main>
    <!--End 页面主要内容-->
	  </div>
</div>
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/js/main.min.js"></script>
<!--消息提示-->
<script src="../assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="../assets/js/lightyear.js"></script>
EOF;

require('./include/function.php');
if(!in_array($_GET['step'], array(1,2,3,4,5))){
	$_GET['step'] = 0;
}
switch ($_GET['step']) {
	case 1:
		require('./include/var.php');
		env_check($env_items);
        dirfile_check($dirfile_items);
        function_check($func_items);
		break;
	case 3:
		$install_error = '';
        $install_recover = '';
        //$demo_data =  file_exists('./data/utf8_add.sql') ? true : false;
        step3($install_error,$install_recover);
        break;
	case 4:
		
		break;
	case 5:
		$sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
        $sitepath = str_replace('install',"",$sitepath);
        $auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].$sitepath);
		break;
	default:
		# code...
		break;
}

include ("step_{$_GET['step']}.php");

function step3(&$install_error,&$install_recover){
    global $html_title,$html_header,$html_footer;
    if ($_POST['submitform'] != 'submit') return;
    $db_host = $_POST['db_host'];
    $db_port = $_POST['db_port'];
    $db_user = $_POST['db_user'];
    $db_pwd = $_POST['db_pwd'];
    $db_name = $_POST['db_name'];
    $db_prefix = $_POST['db_prefix'];
    $admin = $_POST['admin'];
	$email = $_POST['email'];
    $password = $_POST['password'];
    if (!$db_host || !$db_port || !$db_user || !$db_pwd || !$db_name || !$db_prefix  || !$admin || !$email|| !$password){
        $install_error = '输入不完整，请检查';
    }
    if(strpos($db_prefix, '.') !== false) {
        $install_error .= '数据表前缀为空，或者格式错误，请检查';
    }

    if(strlen($admin) > 15 || preg_match("/^$|^c:\\con\\con$|　|[,\"\s\t\<\>&]|^游客|^Guest/is", $admin)) {
        $install_error .= '非法用户名，用户名长度不应当超过 15 个英文字符，且不能包含特殊字符，一般是中文，字母或者数字';
    }
    if ($install_error != '') reutrn;
        $mysqli = @ new mysqli($db_host, $db_user, $db_pwd, '', $db_port);
        if($mysqli->connect_error) {
            $install_error = '数据库连接失败';return;
        }

    if($mysqli->get_server_info()> '5.0') {
        $mysqli->query("CREATE DATABASE IF NOT EXISTS `$db_name` DEFAULT CHARACTER SET ".DBCHARSET);
    } else {
        $install_error = '数据库必须为MySQL5.0版本以上';return;
    }
    if($mysqli->error) {
        $install_error = $mysqli->error;return ;
    }
    if($_POST['install_recover'] != 'yes' && ($query = $mysqli->query("SHOW TABLES FROM $db_name"))) {
        while($row = mysqli_fetch_array($query)) {
            if(preg_match("/^$db_prefix/", $row[0])) {
                $install_error = '数据表已存在，继续安装将会覆盖已有数据';
                $install_recover = 'yes';
                return;
            }
        }
    }

    require ('step_4.php');
    $sitepath = strtolower(substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
    $sitepath = str_replace('install',"",$sitepath);
    $auto_site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].$sitepath);
    write_config($auto_site_url);
    
    $_charset = strtolower(DBCHARSET);
    $mysqli->select_db($db_name);
    $mysqli->set_charset($_charset);
    $sql = file_get_contents("data/{$_charset}.sql");
    //判断是否安装测试数据
    /*if ($_POST['demo_data'] == '1'){
        $sql .= file_get_contents("data/{$_charset}_add.sql");
    }*/
    $sql = str_replace("\r\n", "\n", $sql);
    runquery($sql,$db_prefix,$mysqli);
    showjsmessage('初始化数据 ... 成功');

    /**
     * 转码
     */
    $sitename = $_POST['site_name'];
    $username = $_POST['admin'];
    $password = $_POST['password'];
	$email = $_POST['email'];
    /**
     * 产生随机的md5_key，来替换系统默认的md5_key值
     */
    //$md5_key = md5(random(4).substr(md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT'].$db_host.$db_user.$db_pwd.$db_name.substr(time(), 0, 6)), 8, 6).random(10));
    //$mysqli->query("UPDATE {$db_prefix}setting SET value='".$sitename."' WHERE name='site_name'");
	function hash_md5($password,$salt){
		$password=md5($password).$salt;
		$password=md5($password);
		return $password;
	}
	$addtime = strtotime("now");
	// $salt = md5($username.$addtime.$password);
	// $user_pass = hash_md5($password,$salt);
	$user_pass = $password;
    //添加管理员账号密码
    $mysqli->query("INSERT INTO {$db_prefix}admin (`user`,`pass`,`email`,`status`,`qq`,`addtime`,`updtime`) VALUES ('$username','$user_pass','$email','1','1330166565','$addtime','$addtime');");
	//添加默认网站配置
	$mysqli->query("INSERT INTO {$db_prefix}system (`id`, `title`, `keywords`, `description`, `admin_name`, `admin_qq`, `status`, `user_status`, `info_status`, `info_needlogin`, `index_status`, `index_content`, `msg_status`, `msg_open`, `link1`, `link2`, `link3`, `link4`, `copyright`, `webdata`) VALUES (NULL, 'Daen创意云', 'DCC,Daen创意云,DaenCreativeCloud', 'DCC（DaenCreativeCloud），中文意为：Daen创意云，是一个拥有丰富应用的网站！', 'Daen', '1330166565', '1', '1', '该应用维护中，暂时无法为您提供服务！', '使用该应用前需要登录，请先登录！', '1', '<h3>欢迎使用本系统</h3><br><h5>有问题可留言给我们~</h5><img src=\"http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin=1330166565&src_uin=qq.zy7.com&fid=blog&spec=100\" alt=\"Daen\" />', '1', '1', 'Github https://github.com/daenmax', 'Gitee https://gitee.com/daenmax', 'Weibo https://weibo.com/u/5900928161', 'Blog https://www.jianshu.com/u/e4ef0d518bba', '闽ICP备xxxxxxx号<br>Copyright © 2020. <a target=\"_blank\" href=\"http://daenx.cn\">Daen</a> All rights reserved.', '<script type=\"text/javascript\" src=\"//js.users.51.la/xxxxxx.js\"></script>');");
	//添加例程应用SDK
	$mysqli->query("INSERT INTO {$db_prefix}plugin (`pid`, `id`, `name`, `addtime`, `author`, `authorlink`, `status`, `needlogin`, `popup`, `popup_content`, `sign`) VALUES (NULL, 'shorturl', '短网址', '1592965680', 'Daen', 'QQ1330166565', '1', '0', '1', '欢迎使用短网址\r\n本应用是应用开发SDK，后续开发可参照本应用\r\n<img class=\"img-avatar img-avatar-48 m-r-10\" src=\"http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin=1330166565&src_uin=qq.zy7.com&fid=blog&spec=100\" alt=\"Daen\" />','0');");


    //新增一个标识文件，用来屏蔽重新安装
    $fp = @fopen('lock','wb+');
    @fclose($fp);
    exit("<script type=\"text/javascript\">document.getElementById('install_process').innerHTML = '安装完成，下一步...';document.getElementById('install_process').href='index.php?step=5&username={$username}&password={$password}';</script>");
    exit();
}
//execute sql
function runquery($sql, $db_prefix, $mysqli) {
//  global $lang, $tablepre, $db;
    if(!isset($sql) || empty($sql)) return;
    $sql = str_replace("\r", "\n", str_replace('#__', $db_prefix, $sql));
    $ret = array();
    $num = 0;
    foreach(explode(";\n", trim($sql)) as $query) {
        $ret[$num] = '';
        $queries = explode("\n", trim($query));
        foreach($queries as $query) {
            $ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
        }
        $num++;
    }
    unset($sql);
    foreach($ret as $query) {
        $query = trim($query);
        if($query) {
            if(substr($query, 0, 12) == 'CREATE TABLE') {
                $line = explode('`',$query);
                $data_name = $line[1];
                showjsmessage('数据表  '.$data_name.' ... 创建成功');
                $mysqli->query(droptable($data_name));
                $mysqli->query($query);
                unset($line,$data_name);
            } else {
                $mysqli->query($query);
            }
        }
    }
}
//抛出JS信息
function showjsmessage($message) {
    echo '<script type="text/javascript">showmessage(\''.addslashes($message).' \');</script>'."\r\n";
    flush();
    ob_flush();
}
//写入config文件
function write_config($url) {
    extract($GLOBALS, EXTR_SKIP);
    $config = 'data/config.php';
    $configfile = @file_get_contents($config);
    $configfile = trim($configfile);
    $configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;
    //$charset = 'UTF-8';
    $db_host = $_POST['db_host'];
    $db_port = $_POST['db_port'];
    $db_user = $_POST['db_user'];
    $db_pwd = $_POST['db_pwd'];
    $db_name = $_POST['db_name'];
    $db_prefix = $_POST['db_prefix'];
    $admin = $_POST['admin'];
    $password = $_POST['password'];
    $db_type = 'mysql';
    $cookie_pre = strtoupper(substr(md5(random(6).substr($_SERVER['HTTP_USER_AGENT'].md5($_SERVER['SERVER_ADDR'].$db_host.$db_user.$db_pwd.$db_name.substr(time(), 0, 6)), 8, 6).random(5)),0,4)).'_';
    $configfile = str_replace("===url===",          $url, $configfile);
    $configfile = str_replace("===db_prefix===",    $db_prefix, $configfile);
    //$configfile = str_replace("===db_charset===", $charset, $configfile);
    $configfile = str_replace("===db_host===",      $db_host, $configfile);
    $configfile = str_replace("===db_user===",      $db_user, $configfile);
    $configfile = str_replace("===db_pwd===",       $db_pwd, $configfile);
    $configfile = str_replace("===db_name===",      $db_name, $configfile);
    $configfile = str_replace("===db_port===",      $db_port, $configfile);
    @file_put_contents('../data/config.php', $configfile);
}