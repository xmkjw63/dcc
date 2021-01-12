<?php
$$plugin_id = 'class="active"';
$plugin_active = 'open active';
include '../head.php';
include '../list.php';
$rs=$DB->query("SELECT * FROM ".constant("TABLE")."plugin WHERE id='".$plugin_id."'");
$res = $DB->fetch($rs);
$plugin=array(
	'id' => $res['id'],//应用ID
	'name' => $res['name'],//应用名称
	'addtime' => $res['addtime'],//添加时间
	'author' => $res['author'],//应用作者
	'authorlink' => $res['authorlink'],//联系方式
	'status' => $res['status'],//应用状态，是否可用?1:0
	'needlogin' => $res['needlogin'],//是否需要登录?1:0
	'popup' => $res['popup'],//是否弹窗?1:0
	'popup_content' => $res['popup_content'],//弹窗内容
	'sign' => $res['sign']
);
if($plugin['status']==0){//应用维护提示
	$div_disabled='disabled="disabled"';
	$div_hidden='hidden';
	echo "<script>Daen_confirm('error','啊哦','".$info['plugin_info']."');</script>";
}
if($plugin['status']==1){//是否弹窗公告
	if($plugin['popup']==1){
		echo "<script>Daen_confirm('success','公告','".str_replace(array("\r\n", "\r", "\n"), "<br>", $plugin['popup_content'])."');</script>";
	}
}
if($plugin['needlogin']==1){//是否需要登录
	if($userislogin!=1){
		echo "<script>Daen_confirm('warning','啊哦','".$info['login_info']."');</script>";
	}
}
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">     
    <div class="container-fluid">
        <div class="row">