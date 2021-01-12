<?php
$liname = '用户登录';
include 'head.php';
?>

<style>
body {
    background-color: #fff;
}
.lyear-login-box {
    position: relative;
    overflow-x: hidden;
    width: 100%;
    height: 100%;
    -webkit-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}
.lyear-login-left {
    width: 50%;
    top: 0;
    left: 0;
    bottom: 0;
    position: fixed;
    height: 100%;
    z-index: 555;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
.lyear-overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 10;
    background: rgba(0, 0, 0, 0.5);
}
.lyear-logo {
    margin-bottom: 50px;
}
.lyear-featured {
    z-index: 12;
    position: absolute;
    bottom: 0;
    padding: 30px;
    width: 100%;
}
.lyear-featured h4 {
    color: #fff;
    line-height: 32px;
}
.lyear-featured h4 small {
    color: #fff;
    display: block;
    text-align: right;
    margin-top: 15px;
}
.lyear-login-right {
    margin-left: 50%;
    position: relative;
    z-index: 999;
    padding: 100px;
    background-color: #fff;
}
@media screen and (max-width: 1024px) {
.lyear-login-right {
    padding: 50px;
}
}
@media screen and (max-width: 820px) {
.lyear-login-left {
    width: 100%;
    position: relative;
    z-index: 999;
    height: 300px;
}
.lyear-login-right {
    margin-left: 0;
}
}
@media screen and (max-width: 480px) {
.lyear-login-right {
    padding: 50px;
}
}
@media screen and (max-width: 320px) {
.lyear-login-right {
    padding: 30px;
}
}
</style>
</head>
  
<body>
<div class="lyear-login-box">
  <div class="lyear-login-left" style="background-image: url(../assets/images/login-bg.jpg)">
    <div class="lyear-overlay"></div>
    <div class="lyear-featured">
      <h4>愿你有好运气，如果没有，愿你在不幸中学会慈悲；愿你被很多人爱，如果没有，愿你在寂寞中学会宽容。<small> - 刘瑜《愿你慢慢长大》</small></h4>
    </div>
  </div>
  <div class="lyear-login-right">
    
    <div class="lyear-logo text-center"> 
      <a href="#!"><img src="../assets/images/logo-sidebar.png" alt="logo" /></a> 
    </div>
    <form action="./login.php" method="post">
      <div class="form-group">
        <label for="username">账号</label>
        <input type="text" class="form-control" name="user" id="user" placeholder="请输入您的账号或者QQ" required >
      </div>

      <div class="form-group">
        <label for="password">密码</label>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="请输入您的密码" required >
      </div>

      <div class="form-group">
        <label for="code">验证码</label>
        <div class="row">
          <div class="col-xs-8">
            <input type="text" name="code" id="code" class="form-control" placeholder="请输入验证码" required>
          </div>
          <div class="col-xs-4">
            <img src="../data/code.php?r=<?php echo time();?>" class="pull-right" id="code" style="cursor: pointer;" onclick="this.src='../data/code.php?r='+Math.random();" title="点击刷新" alt="code">
          </div>
        </div>
      </div>

      <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit">立即登录</button>
      </div>
      <footer class="text-center">
        <p class="m-b-0">Copyright © 2020 <a href="http://daenx.cn">Daen</a>. All right reserved</p>
      </footer>
    </form>
<?php
if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['code'])){
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);	
	$code=daddslashes($_POST['code']);
	if(!$code || strtolower($_SESSION['mulin_code'])!=strtolower($code)){
		echo "<script>Daen_confirm('error','啊哦','验证码错误');</script>";
		exit();
	}
	$rs=$DB->query("select * from ".constant("TABLE")."admin where user = '".$user."' or qq = '".$user."'");
	if($res = $DB->fetch($rs)){
        if($pass == $res['pass']){
			if($res['status']==0){
				echo "<script>Daen_notify('error','此账号已被禁止登录');</script>";
			}else{
				$session=md5($res['user'].$res['pass'].$password_hash);
				$token=authcode("{$res['aid']}\t{$res['user']}\t{$res['qq']}\t{$session}", 'ENCODE', SYS_KEY);
				setcookie("admin_token", $token, time() + 604800);
				$rs=$DB->query("UPDATE ".constant("TABLE")."admin SET updtime='".time()."' WHERE aid='".$res['aid']."'");
				echo "<script>Daen_confirm('success','叮叮','登录成功',true,'./');</script>";
			} 
        }else{
			echo "<script>Daen_confirm('error','啊哦','密码错误');</script>";     
        }
    }else{
		echo "<script>Daen_confirm('error','啊哦','账号或者密码错误');</script>";	
    }	
}elseif(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	echo "<script>Daen_confirm('success','叮叮','退出登录成功！',true,'./');</script>";
}elseif($adminislogin==1){
	 echo "<script>Daen_confirm('warning','叮叮','您已登录！',true,'./');</script>";
}
?>    
<?php
include 'footer.php';
?>