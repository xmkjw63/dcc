<?php
function number($num){//判断是否为纯数字
	$pattern = '/^\d+(\.\d+)?$/';
	if(preg_match($pattern,$num)){
		return true;
	}else{
		return false;
	}
}
function isVaptcha($vid,$key,$token,$ip){//计算Vaptcha手势验证码是否合法
	if($token==''){
		return false;
	}
	$dataurl = 'http://0.vaptcha.com/verify';
	$post_data = 'id='.$vid.'&secretkey='.$key.'&ip='.$ip.'&scene=0&token='.$token;
	$json = json_decode(get_curl($dataurl, $post_data,null,null),true);
	if($json['success']==1){
		return true;
	}else{
		return false;
	}
}

function curl_get($url){//简易GET网络请求
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$content=curl_exec($ch);
	curl_close($ch);
	return($content);
}

function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0){//GET\POST网络请求
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept:*/*";
	$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
	$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
	$httpheader[] = "Connection:close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

function real_ip(){//获取用户真实IP
	$ip = $_SERVER['REMOTE_ADDR'];
	if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
		foreach ($matches[0] AS $xip) {
			if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
				$ip = $xip;
				break;
			}
		}
	}
	return $ip;
}


function get_ip_city($ip){
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=';
    @$city = curl_get($url . $ip);
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['province'].$city['city'];
    } else {
        $location = $city['province'];
    }
	if($location){
		return $location;
	}else{
		return false;
	}
}

function send_mail($to, $sub, $msg){
	global $conf;
	include_once ROOT.'includes/smtp.class.php';
	$From = $conf['mail_name'];
	$Host = $conf['mail_stmp'];
	$Port = $conf['mail_port'];
	$SMTPAuth = 1;
	$Username = $conf['mail_name'];
	$Password = $conf['mail_pwd'];
	$Nickname = $conf['sitename'];
	$SSL = false;
	$mail = new SMTP($Host , $Port , $SMTPAuth , $Username , $Password , $SSL);
	$mail->att = array();
	if($mail->send($to , $From , $sub , $msg, $Nickname)) {
		return true;
	} else {
		return $mail->log;
	}
}

function daddslashes($string, $force = 0, $strip = FALSE) {//在每个双引号（"）前添加反斜杠
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function strexists($string, $find) {//取字符串中是否包含指定字符串
	return !(strpos($string, $find) === FALSE);
}
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {//验证
	$ckey_length = 4;
	$key = md5($key ? $key : ENCRYPT_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function random($length, $numeric = 0) {//取随机字符串
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}

function ins_log($db,$pid,$uid,$status){//添加应用使用日志
	$aaa = array(
		"pid"=>$pid,
		"uid"=>$uid,
		"time"=>time(),
		"status"=>$status
	);
	$rs=$db->insert_array(constant("TABLE")."plog",$aaa);
	return;
}
function isRight($requst,$requstArr){//判断一个字符串是否存在另一个字符串数组中，判断请求的指令是否正确
	$num = count($requstArr);
	for($i=0;$i<$num;$i++){
		if($requst == $requstArr[$i]){
			return true;
		}
	}
}
function getPluginId($file_url){//传入路径explode("\\",__FILE__)，获取当前API对应的应用ID，例如glutsz
	$tmp = explode("\\",$file_url);
	return $tmp[count($tmp)-2];
}
function getUserTotal($db){
	$date = array(
		strtotime(date("Y-m-d", strtotime("-6 day"))),
		strtotime(date("Y-m-d", strtotime("-5 day"))),
		strtotime(date("Y-m-d", strtotime("-4 day"))),
		strtotime(date("Y-m-d", strtotime("-3 day"))),
		strtotime(date("Y-m-d", strtotime("-2 day"))),
		strtotime(date("Y-m-d", strtotime("-1 day"))),
		strtotime(date("Y-m-d", strtotime("0 day"))),
		time()
	);
	$num0=0;$num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$num6=0;
	$rs=$db->query("select * FROM ".constant("TABLE")."user");
	while($res = $db->fetch($rs)){
		
		if($res['addtime'] >= $date['0'] && $res['addtime'] < $date['1']){
			$num0 = $num0 + 1;
		}
		if($res['addtime'] >= $date['1'] && $res['addtime'] < $date['2']){
			$num1 = $num1 + 1;
		}
		if($res['addtime'] >= $date['2'] && $res['addtime'] < $date['3']){
			$num2 = $num2 + 1;
		}
		if($res['addtime'] >= $date['3'] && $res['addtime'] < $date['4']){
			$num3 = $num3 + 1;
		}
		if($res['addtime'] >= $date['4'] && $res['addtime'] < $date['5']){
			$num4 = $num4 + 1;
		}
		if($res['addtime'] >= $date['5'] && $res['addtime'] < $date['6']){
			$num5 = $num5 + 1;
		}
		if($res['addtime'] >= $date['6'] && $res['addtime'] < $date['7']){
			$num6 = $num6 + 1;
		}
	}
	
	$num = array($num0,$num1,$num2,$num3,$num4,$num5,$num6);
	return $num;
}
function getPluginTotal($db){
	$date = array(
		strtotime(date("Y-m-d", strtotime("-13 day"))),
		strtotime(date("Y-m-d", strtotime("-12 day"))),
		strtotime(date("Y-m-d", strtotime("-11 day"))),
		strtotime(date("Y-m-d", strtotime("-10 day"))),
		strtotime(date("Y-m-d", strtotime("-9 day"))),
		strtotime(date("Y-m-d", strtotime("-8 day"))),
		strtotime(date("Y-m-d", strtotime("-7 day"))),
		strtotime(date("Y-m-d", strtotime("-6 day"))),
		strtotime(date("Y-m-d", strtotime("-5 day"))),
		strtotime(date("Y-m-d", strtotime("-4 day"))),
		strtotime(date("Y-m-d", strtotime("-3 day"))),
		strtotime(date("Y-m-d", strtotime("-2 day"))),
		strtotime(date("Y-m-d", strtotime("-1 day"))),
		strtotime(date("Y-m-d", strtotime("0 day"))),
		time()
	);
	$num0=0;$num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$num6=0;$num7=0;$num8=0;$num9=0;$num10=0;$num11=0;$num12=0;$num13=0;
	$rs=$db->query("select * FROM ".constant("TABLE")."plog where status='1'");
	while($res = $db->fetch($rs)){
		if($res['time'] >= $date['0'] && $res['time'] < $date['1']){
			$num0 = $num0 + 1;
		}
		if($res['time'] >= $date['1'] && $res['time'] < $date['2']){
			$num1 = $num1 + 1;
		}
		if($res['time'] >= $date['2'] && $res['time'] < $date['3']){
			$num2 = $num2 + 1;
		}
		if($res['time'] >= $date['3'] && $res['time'] < $date['4']){
			$num3 = $num3 + 1;
		}
		if($res['time'] >= $date['4'] && $res['time'] < $date['5']){
			$num4 = $num4 + 1;
		}
		if($res['time'] >= $date['5'] && $res['time'] < $date['6']){
			$num5 = $num5 + 1;
		}
		if($res['time'] >= $date['6'] && $res['time'] < $date['7']){
			$num6 = $num6 + 1;
		}
		if($res['time'] >= $date['7'] && $res['time'] < $date['8']){
			$num7 = $num7 + 1;
		}
		if($res['time'] >= $date['8'] && $res['time'] < $date['9']){
			$num8 = $num8 + 1;
		}
		if($res['time'] >= $date['9'] && $res['time'] < $date['10']){
			$num9 = $num9 + 1;
		}
		if($res['time'] >= $date['10'] && $res['time'] < $date['11']){
			$num10 = $num10 + 1;
		}
		if($res['time'] >= $date['11'] && $res['time'] < $date['12']){
			$num11 = $num11 + 1;
		}
		if($res['time'] >= $date['12'] && $res['time'] < $date['13']){
			$num12 = $num12 + 1;
		}
		if($res['time'] >= $date['13'] && $res['time'] < $date['14']){
			$num13 = $num13 + 1;
		}
	}
	$num00=0;$num11=0;$num22=0;$num33=0;$num44=0;$num55=0;$num66=0;$num77=0;$num88=0;$num99=0;$num1010=0;$num1111=0;$num1212=0;$num1313=0;
	$rs=$db->query("select * FROM ".constant("TABLE")."plog where status='0'");
	while($res = $db->fetch($rs)){
		if($res['time'] >= $date['0'] && $res['time'] < $date['1']){
			$num00 = $num00 + 1;
		}
		if($res['time'] >= $date['1'] && $res['time'] < $date['2']){
			$num11 = $num11 + 1;
		}
		if($res['time'] >= $date['2'] && $res['time'] < $date['3']){
			$num22 = $num22 + 1;
		}
		if($res['time'] >= $date['3'] && $res['time'] < $date['4']){
			$num33 = $num33 + 1;
		}
		if($res['time'] >= $date['4'] && $res['time'] < $date['5']){
			$num44 = $num44 + 1;
		}
		if($res['time'] >= $date['5'] && $res['time'] < $date['6']){
			$num55 = $num55 + 1;
		}
		if($res['time'] >= $date['6'] && $res['time'] < $date['7']){
			$num66 = $num66 + 1;
		}
		if($res['time'] >= $date['7'] && $res['time'] < $date['8']){
			$num77 = $num77 + 1;
		}
		if($res['time'] >= $date['8'] && $res['time'] < $date['9']){
			$num88 = $num88 + 1;
		}
		if($res['time'] >= $date['9'] && $res['time'] < $date['10']){
			$num99 = $num99 + 1;
		}
		if($res['time'] >= $date['10'] && $res['time'] < $date['11']){
			$num1010 = $num1010 + 1;
		}
		if($res['time'] >= $date['11'] && $res['time'] < $date['12']){
			$num1111 = $num1111 + 1;
		}
		if($res['time'] >= $date['12'] && $res['time'] < $date['13']){
			$num1212 = $num1212 + 1;
		}
		if($res['time'] >= $date['13'] && $res['time'] < $date['14']){
			$num1313 = $num1313 + 1;
		}
	}
	$num = array(array($num0,$num00),array($num1,$num11),array($num2,$num22),array($num3,$num33),array($num4,$num44),array($num5,$num55),array($num6,$num66),array($num7,$num77),array($num8,$num88),array($num9,$num99),array($num10,$num1010),array($num11,$num1111),array($num12,$num1212),array($num13,$num1313));
	return $num;
}
function getPlugin($db,$pid){
	$date = array(
		strtotime(date("Y-m-d", strtotime("-13 day"))),
		strtotime(date("Y-m-d", strtotime("-12 day"))),
		strtotime(date("Y-m-d", strtotime("-11 day"))),
		strtotime(date("Y-m-d", strtotime("-10 day"))),
		strtotime(date("Y-m-d", strtotime("-9 day"))),
		strtotime(date("Y-m-d", strtotime("-8 day"))),
		strtotime(date("Y-m-d", strtotime("-7 day"))),
		strtotime(date("Y-m-d", strtotime("-6 day"))),
		strtotime(date("Y-m-d", strtotime("-5 day"))),
		strtotime(date("Y-m-d", strtotime("-4 day"))),
		strtotime(date("Y-m-d", strtotime("-3 day"))),
		strtotime(date("Y-m-d", strtotime("-2 day"))),
		strtotime(date("Y-m-d", strtotime("-1 day"))),
		strtotime(date("Y-m-d", strtotime("0 day"))),
		time()
	);
	$num0=0;$num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$num6=0;$num7=0;$num8=0;$num9=0;$num10=0;$num11=0;$num12=0;$num13=0;
	$rs=$db->query("select * FROM ".constant("TABLE")."plog where status='1' and pid='".$pid."'");
	while($res = $db->fetch($rs)){
		if($res['time'] >= $date['0'] && $res['time'] < $date['1']){
			$num0 = $num0 + 1;
		}
		if($res['time'] >= $date['1'] && $res['time'] < $date['2']){
			$num1 = $num1 + 1;
		}
		if($res['time'] >= $date['2'] && $res['time'] < $date['3']){
			$num2 = $num2 + 1;
		}
		if($res['time'] >= $date['3'] && $res['time'] < $date['4']){
			$num3 = $num3 + 1;
		}
		if($res['time'] >= $date['4'] && $res['time'] < $date['5']){
			$num4 = $num4 + 1;
		}
		if($res['time'] >= $date['5'] && $res['time'] < $date['6']){
			$num5 = $num5 + 1;
		}
		if($res['time'] >= $date['6'] && $res['time'] < $date['7']){
			$num6 = $num6 + 1;
		}
		if($res['time'] >= $date['7'] && $res['time'] < $date['8']){
			$num7 = $num7 + 1;
		}
		if($res['time'] >= $date['8'] && $res['time'] < $date['9']){
			$num8 = $num8 + 1;
		}
		if($res['time'] >= $date['9'] && $res['time'] < $date['10']){
			$num9 = $num9 + 1;
		}
		if($res['time'] >= $date['10'] && $res['time'] < $date['11']){
			$num10 = $num10 + 1;
		}
		if($res['time'] >= $date['11'] && $res['time'] < $date['12']){
			$num11 = $num11 + 1;
		}
		if($res['time'] >= $date['12'] && $res['time'] < $date['13']){
			$num12 = $num12 + 1;
		}
		if($res['time'] >= $date['13'] && $res['time'] < $date['14']){
			$num13 = $num13 + 1;
		}
	}
	$num00=0;$num11=0;$num22=0;$num33=0;$num44=0;$num55=0;$num66=0;$num77=0;$num88=0;$num99=0;$num1010=0;$num1111=0;$num1212=0;$num1313=0;
	$rs=$db->query("select * FROM ".constant("TABLE")."plog where status='0' and pid='".$pid."'");
	while($res = $db->fetch($rs)){
		if($res['time'] >= $date['0'] && $res['time'] < $date['1']){
			$num00 = $num00 + 1;
		}
		if($res['time'] >= $date['1'] && $res['time'] < $date['2']){
			$num11 = $num11 + 1;
		}
		if($res['time'] >= $date['2'] && $res['time'] < $date['3']){
			$num22 = $num22 + 1;
		}
		if($res['time'] >= $date['3'] && $res['time'] < $date['4']){
			$num33 = $num33 + 1;
		}
		if($res['time'] >= $date['4'] && $res['time'] < $date['5']){
			$num44 = $num44 + 1;
		}
		if($res['time'] >= $date['5'] && $res['time'] < $date['6']){
			$num55 = $num55 + 1;
		}
		if($res['time'] >= $date['6'] && $res['time'] < $date['7']){
			$num66 = $num66 + 1;
		}
		if($res['time'] >= $date['7'] && $res['time'] < $date['8']){
			$num77 = $num77 + 1;
		}
		if($res['time'] >= $date['8'] && $res['time'] < $date['9']){
			$num88 = $num88 + 1;
		}
		if($res['time'] >= $date['9'] && $res['time'] < $date['10']){
			$num99 = $num99 + 1;
		}
		if($res['time'] >= $date['10'] && $res['time'] < $date['11']){
			$num1010 = $num1010 + 1;
		}
		if($res['time'] >= $date['11'] && $res['time'] < $date['12']){
			$num1111 = $num1111 + 1;
		}
		if($res['time'] >= $date['12'] && $res['time'] < $date['13']){
			$num1212 = $num1212 + 1;
		}
		if($res['time'] >= $date['13'] && $res['time'] < $date['14']){
			$num1313 = $num1313 + 1;
		}
	}
	$num = array(array($num0,$num00),array($num1,$num11),array($num2,$num22),array($num3,$num33),array($num4,$num44),array($num5,$num55),array($num6,$num66),array($num7,$num77),array($num8,$num88),array($num9,$num99),array($num10,$num1010),array($num11,$num1111),array($num12,$num1212),array($num13,$num1313));
	return $num;
}
?>