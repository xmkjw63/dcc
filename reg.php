<?php
$index_active = 'active';
$plugin_name = '登录';
include 'head.php';
include 'list.php';
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
			
				
				<div class="card" id="div_reg">
				  <div class="card-header" id="card_title"><h4>注册</h4></div>
				  <div class="card-body">
					  <div class="lyear-login">
						<div class="login-center">
							<div class="form-group has-feedback feedback-left">
							  <input type="text" placeholder="请输入账号(支持中文)" class="form-control" name="reg_user" id="reg_user"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group has-feedback feedback-left">
							  <input type="text" placeholder="请输入QQ" class="form-control" name="reg_qq" id="reg_qq"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-qqchat form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group has-feedback feedback-left">
							  <input type="password" placeholder="请输入密码" class="form-control" id="reg_pass" name="reg_pass"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group has-feedback feedback-left">
							  <input type="password" placeholder="请再次输入密码" class="form-control" id="reg_pass_re" name="reg_pass_re"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
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
									<button class="btn btn-block btn-dark btn-round" type="button" id="reg_reg" <?php echo $div_disabled;?>>注册</button>
								</div>
								<div class="col-xs-4">
									<a class="btn btn-block btn-purple btn-round" href="./login.php">登录</a>
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
	$('#reg_reg').click(function(){
		var self = $(this);
		var user = trim($('#reg_user').val());
		var qq = trim($('#reg_qq').val());
		var pass = trim($('#reg_pass').val());
		var repass = trim($('#reg_pass_re').val());
		if(user == '' || qq == '' || pass == '' || repass == '') {
			Daen_notify('warning','请填写完整哦');
			return false;
		}
		if(pass != repass) {
			Daen_notify('error','两次密码输入的不一致');
			return false;
		}
		if(token=='') {
            Daen_notify('warning','请进行人机验证哦');
            return false;
        }
		var data = {user: user,pass: pass,qq: qq,token: token};
		$.post("ajax.php?do=reg", data, function (r) {
			  if (r.code == 200) {
				  Daen_confirm('success','叮叮','注册成功，请登录',true,'./login.php')
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