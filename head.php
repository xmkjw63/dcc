<?php
//优化页面载入资源问题
$assets_url = substr_count($_SERVER['PHP_SELF'],"/");
if($assets_url == 1){
	$assets_url = './';
}else{
	$assets_url = '../';
}
?>
<?php
//判断是否安装过程序
if(!file_exists($assets_url.'install/lock')){
	header("Content-type: text/html; charset=UTF-8");
    echo '系统还没安装！<a href="'.$assets_url.'install/">点此安装</a>';
    exit;
}
?>
<?php
include($assets_url."data/common.php");
if($system['status']!=1){
	include($assets_url."data/repair.php");
	die();
}
include($assets_url."data/member.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><? echo $system['title'];?> - <? echo $plugin_name;?></title>
<link rel="icon" href="<? echo $assets_url;?>favicon.ico" type="image/ico">
<meta name="keywords" content="<? echo $system['keywords'];?>">
<meta name="description" content="<? echo $system['description'];?>">
<meta name="author" content="<? echo $system['admin_name'];?>">
<link href="<? echo $assets_url;?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<? echo $assets_url;?>assets/css/materialdesignicons.min.css" rel="stylesheet">
<link href="<? echo $assets_url;?>assets/css/style.min.css" rel="stylesheet">
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/main.min.js"></script>
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/jquery.cookie.js"></script>

<script src="<? echo $assets_url;?>data/function.js"></script>
<!--消息提示-->
<script src="<? echo $assets_url;?>assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="<? echo $assets_url;?>assets/js/lightyear.js"></script>
<!--对话框-->
<script src="<? echo $assets_url;?>assets/js/jconfirm/jquery-confirm.min.js"></script>
<link href="<? echo $assets_url;?>assets/js/jconfirm/jquery-confirm.min.css" rel="stylesheet">

<script language="javascript">
function logout(url){
	$.confirm({
        title: '叮叮',
        content: '确定要退出吗？<?=$user?>',
        type: 'green',
        buttons: {
            omg: {
                text: '确定',
                btnClass: 'btn-green',
				action: function(){
					$.post(url+"ajax.php?do=logout",'' , function (r) {
					  if (r.code == 200) {
						  Daen_confirm('success','叮叮',r.msg,true,url+'login.php')
					  }else{
						  Daen_notify('error',r.msg);
					  }
					},"json");
                }
            },
            close: {
                text: '取消',
				action: function(){
                }
            }
        }
	});
}
</script>
