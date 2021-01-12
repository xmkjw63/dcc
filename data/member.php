<?php
if(!defined('IN_CRONLITE'))exit();
$my=isset($_GET['my'])?$_GET['my']:null;
$clientip=$_SERVER['REMOTE_ADDR'];

if(strpos($_SERVER['PHP_SELF'],'admin')!=false){
	if(isset($_COOKIE["admin_token"])&&!empty($_COOKIE["admin_token"])){
		$admin_token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
		list($aid,$user,$qq,$session) = explode("\t", $admin_token);
		$rs=$DB->query("select * from ".constant("TABLE")."admin where aid = '".$aid."'");
		$res = $DB->fetch($rs);
		$new_session=md5($res["user"].$res["pass"].$password_hash);
		if($new_session == $session){
			if($res["status"]==0){
			setcookie("admin_token", "", time() - 604800);
			$adminislogin=0;
			echo "<script>Daen_confirm('error','您的账号已被禁止登录','请联系管理员');</script>";
			}else{
				$adminislogin=1;
				$rs=$DB->query("UPDATE ".constant("TABLE")."admin SET updtime='".time()."' WHERE aid='".$aid."'");
			}
		}
	
	}
}else{
	if(isset($_COOKIE["user_token"])&&!empty($_COOKIE["user_token"])){
		$user_token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
		list($uid,$user,$qq,$session) = explode("\t", $user_token);
		$rs=$DB->query("select * from ".constant("TABLE")."user where uid = '".$uid."'");
		$res = $DB->fetch($rs);
		$new_session=md5($res["user"].$res["pass"].$password_hash);
		if($new_session == $session){
			if($res["status"]==0){
			setcookie("user_token", "", time() - 604800);
			$userislogin=0;
			echo "<script>Daen_confirm('error','您的账号已被禁止登录','请联系管理员');</script>";
			}else{
				echo "<script>console.log('已登录');</script>";
				$userislogin=1;
				$rs=$DB->query("UPDATE ".constant("TABLE")."user SET updtime='".time()."' WHERE uid='".$uid."'");
			}
		}
	}
}


?>