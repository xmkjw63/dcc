<?php
$index_active = 'active';
$plugin_name = '登录';
include 'head.php';
include 'list.php';
if($userislogin==1){
   echo "<script>Daen_confirm('success','叮叮','你已经登录了哦',true,'./index.php');</script>";
}
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
			
				<div class="card" id="div_login">
				  <div class="card-header" id="card_title"><h4>登录</h4></div>
				  <div class="card-body">
					  <div class="lyear-login">
						<div class="login-center">
							<div class="form-group has-feedback feedback-left">
							  <input type="text" placeholder="请输入账号或者QQ" class="form-control" name="lg_user" id="lg_user"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group has-feedback feedback-left">
							  <input type="password" placeholder="请输入密码" class="form-control" id="lg_pass" name="lg_pass"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
							</div>

<style>
  .vaptcha-init-main {
    display: table;
    width: 100%;
    height: 100%;
    background-color: #eeeeee;
  }
​
  .vaptcha-init-loading {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
  }
​
  .vaptcha-init-loading > a {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: none;
  }
​
  .vaptcha-init-loading > a img {
    vertical-align: middle;
  }
​
  .vaptcha-init-loading .vaptcha-text {
    font-family: sans-serif;
    font-size: 12px;
    color: #cccccc;
    vertical-align: middle;
  }
</style>
<!-- 点击式按钮建议高度介于36px与46px  -->
<div id="vaptchaContainer" style="width: 300px;height: 36px;">
  <!--vaptcha-container是用来引入VAPTCHA的容器，下面代码为预加载动画，仅供参考-->
  <div class="vaptcha-init-main">
    <div class="vaptcha-init-loading">
      <a href="/" target="_blank">
        <img src="https://r.vaptcha.net/public/img/vaptcha-loading.gif" />
      </a>
      <span class="vaptcha-text">Vaptcha启动中...</span>
    </div>
  </div>
</div>
<script src="https://v.vaptcha.com/v3.js"></script>
<script>
var token='';
vaptcha({
  vid: '<?=$system["sign_vid"]?>', // 验证单元id
  type: "click", // 显示类型 点击式
  scene: 0, // 场景值 默认0
  container: "#vaptchaContainer",
}).then(function (vaptchaObj) {
  obj = vaptchaObj;
  vaptchaObj.render();
  vaptchaObj.listen("pass", function () {
		token = vaptchaObj.getToken();
		Daen_notify('success','验证通过');
  });
  //关闭验证弹窗时触发
  vaptchaObj.listen("close", function () {
		Daen_notify('warning','您取消了人机验证');
  });
});
</script>
							<div class="form-group">
								<br>
								<div class="col-xs-8">
									<button class="btn btn-block btn-primary btn-round" type="button" id="lg_login">登录</button>
								</div>
								<div class="col-xs-4">
									<a class="btn btn-block btn-info btn-round" href="./reg.php">注册</a>
								</div>
							</div>
							<div class="form-group">
								<br>
							</div>				  
						</div>
					  </div>
					</div>
		        </div>			
		    </div>
		</div>


    </div>       
    </main>
    <!--End 页面主要内容-->
<script>
$(document).ready(function(){
	$('#lg_login').click(function(){
		var self = $(this);
		var user = trim($('#lg_user').val());
		var pass = trim($('#lg_pass').val());
		if(user == '' || pass == '') {
			Daen_notify('warning','请填写完整哦');
			return false;
		}
		if(token=='') {
            Daen_notify('warning','请进行人机验证哦');
            return false;
        }
		var data = {user: user,pass: pass,token: token};
		$.post("ajax.php?do=login", data, function (r) {
			  if (r.code == 200) {
				  Daen_confirm('success','叮叮','登录成功',true,'./');
			  }else{
				  Daen_notify('error',r.msg);
			  }
		},"json");
	});
});
</script>
<?php
include 'footer.php';
?>