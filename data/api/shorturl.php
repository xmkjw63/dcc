<?php
//定义有效指令数组和应用ID
$requstArr = array("shorturl","longurl");//定义的指令数组
$plugin_id = 'shorturl';//应用ID

include '../../data/common.php';
$do = $_GET["do"];
if(isRight($do,$requstArr)){//判断指令是否正确，如果正确即进入处理
	$api = new API();
	$user_token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
	list($uid,$user,$qq,$session) = explode("\t", $user_token);//解析cookies里的user_token;
	$rs = $DB->query("SELECT * FROM ".constant("TABLE")."plugin WHERE id='".$plugin_id."'");
	$res = $DB->fetch($rs);
	if($res['status']==0){
		$data = array(
		"status"=>0,
		"msg"=>$info['plugin_info'],
		"pg_id"=>$res['id'],
		"pg_name"=>$res['name']
		);
		ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
		echo json_encode($data);
		return;
	}
	if($res['needlogin']==1){
		if($uid==''){
			$data = array(
			"status"=>0,
			"msg"=>$info['login_info'],
			"pg_id"=>$res['id'],
			"pg_name"=>$res['name']
			);
			ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
			echo json_encode($data);
			return;
		}
	}
	if($res['sign']==1){
		if(isVaptcha($system['sign_vid'],$system['sign_key'],$_POST['token'],real_ip())!=true){
			$data = array(
			"status"=>0,
			"msg"=>'token error',
			"pg_id"=>$res['id'],
			"pg_name"=>$res['name']
			);
			ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
			echo json_encode($data);
			return;
		}
	}
	ins_log($DB,$res['pid'],$uid,1);//添加应用使用日志：请求成功
	//请求入口
	switch($do){
		case $requstArr[0]:
			echo $api->shorturl($_POST['url']);
			break;
		case $requstArr[1]:
			echo $api->longurl($_POST['url']);
			break;
		default://此处的default无意义，因为我们在上方已经对指令正确性做了处理，错误的请求指令将不会进入此
			return;
	}
	return;
}

//定义函数
class API{
	//这里只是一个应用开发例程，所以就套娃调用别人的API做演示了
	public function shorturl($url){//缩短
		$dataurl = 'https://api.oioweb.cn/api/dwz.php?type=2&url='.$url;
		$json = get_curl($dataurl);
		return $json;
		//{"code":1,"msg":"生成成功！","url":{"url_short":"https://url.cn/iS0NMUHH","url_long":"https://blog.oioweb.cn/"}}
	}	
	public function longurl($url){//还原
		$dataurl = 'https://api.oioweb.cn/api/dwzreduction.php?url='.$url;
		$json = get_curl($dataurl);
		return $json;
		//{"code":1,"msg":"获取成功","data":{"dwz":"https://url.cn/zh0tNR7E","dwzreduction":"https://blog.oioweb.cn/"}}
	}	
}
?>