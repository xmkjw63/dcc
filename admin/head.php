<?php
//判断是否安装过程序
if(!file_exists('../install/lock')){
	header("Content-type: text/html; charset=UTF-8");
    echo '系统还没安装！<a href="../install/">点此安装</a>';
    exit;
}
?>
<?php
include("../data/common.php");
include_once("../data/member.php");
if($liname!="用户登录"){
	if($adminislogin != 1){
	exit("<script language='javascript'>window.location.href='./login.php';</script>");
	}
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><? echo $system['title'];?> - <? echo $liname;?></title>
<link rel="icon" href="../favicon.ico" type="image/ico">
<meta name="keywords" content="<? echo $system['keywords'];?>">
<meta name="description" content="<? echo $system['description'];?>">
<meta name="author" content="<? echo $system['admin_name'];?>">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../assets/css/style.min.css" rel="stylesheet">
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/js/main.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.cookie.js"></script>
<script src="../data/function.js"></script>
<!--消息提示-->
<script src="../assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="../assets/js/lightyear.js"></script>
<!--对话框-->
<script src="../assets/js/jconfirm/jquery-confirm.min.js"></script>
<link href="../assets/js/jconfirm/jquery-confirm.min.css" rel="stylesheet">


<script language="javascript">
function logout(){
	Daen_confirm('info','叮叮','确定要退出吗？',true,'login.php?logout');
}
</script>
</head>

