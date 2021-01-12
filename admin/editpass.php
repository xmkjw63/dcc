<?php
$li1 = 'active';
$liname = '修改密码';
include 'head.php';
include 'list.php';
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
			
				<div class="card" id="div_login">
				  <div class="card-header" id="card_title"><h4>修改密码</h4></div>
				  <div class="card-body">
					  <div class="lyear-login">
						<div class="login-center">
						<form action="./editpass.php" method="POST" >
							<div class="form-group has-feedback feedback-left">
							  <input type="password" placeholder="请输入当前密码" class="form-control" name="edit_pass" id="edit_pass"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group has-feedback feedback-left">
							  <input type="password" placeholder="请输入新密码" class="form-control" id="edit_newpass" name="edit_newpass"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
							  <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-primary" type="submit" id="edit_btn">修改</button>
							</div>
						</form>						  
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
	$('#edit_btn').click(function(){
		var self = $(this);
		var pass = trim($('#edit_pass').val());
		var newpass = trim($('#edit_newpass').val());
		if(pass == '' || newpass == '') {
			Daen_notify('warning','请填写完整当前密码和新密码哦');
			return false;
		}
		$('#edit_btn').attr('do','submit');	
	});
});
</script>
<?php
if(!empty($_POST['edit_pass']) && !empty($_POST['edit_newpass'])){
    $pass=daddslashes($_POST['edit_pass']);
	$newpass=daddslashes($_POST['edit_newpass']);
    $rs=$DB->query("select * from ".constant("TABLE")."admin where aid = '".$aid."'");
    if($res = $DB->fetch($rs)){
        if($pass == $res['pass']){
			if($res['status']==0){
				echo "<script>Daen_notify('error','此账号已被禁止登录');</script>";
			}else{
				$rs=$DB->query("UPDATE ".constant("TABLE")."admin SET pass='".$newpass."' WHERE aid='".$res['aid']."'");
				echo "<script>Daen_confirm('success','叮叮','修改成功，请重新登录',true,'./login.php');</script>";
			} 
        }else{
			echo "<script>Daen_notify('error','当前密码输入错误');</script>";  
        }
    }else{
		echo "<script>Daen_notify('error','修改密码失败');</script>";	
    }
}
?>
<?php
include 'footer.php';
?>