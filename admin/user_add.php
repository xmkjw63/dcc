<?php
$li3 = 'open active';
$li32 = 'active';
$liname = '用户添加';
include 'head.php';
include 'list.php';
?>
<?php
$action = $_GET['action'];
if($action=='do'){
	$data = array(
		"user"=>$_POST['user_user'],
		"pass"=>$_POST['user_pass'],
		"addtime"=>time(),
		"qq"=>$_POST['user_qq'],
		"status"=>$_POST['user_status']
	);
	$rs=$DB->insert_array(constant("TABLE")."user",$data);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','用户添加成功',true,'user_man.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','用户添加失败');</script>";
	}
}

?>    

    <!--页面主要内容-->
    <main class="lyear-layout-content">     
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" id="card_title"><h4><? echo $liname;?></h4></div>
					<div class="card-body">		
					  <div class="lyear-add">
						<div class="add-center">
						<form action="user_add.php?action=do" method="post"  role="form">
						  <div id="add">						  
							<div class="form-group">
							  <label class="">账号</label>
							  <input type="text" placeholder="请输入账号" class="form-control" name="user_user" id="user_user" required />
							</div>
							<div class="form-group">
							  <label class="">密码</label>
							  <input type="text" placeholder="请输入密码" class="form-control" name="user_pass" id="user_pass" required />							  
							</div>
							<div class="form-group">
							  <label class="">QQ</label>
							  <input type="text" placeholder="请输入QQ" class="form-control" name="user_qq" id="user_qq" required />
							</div>
							<div class="form-group">
							  <label class="">用户状态</label>
							    <select class="form-control" id="user_status" name="user_status" size="1">
									<option value="1">正常</option>
									<option value="0">禁用</option>
								</select>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-primary" type="submit" id="submit">添加</button>
							</div>
						  </div>
						  </form>						  
						</div>
					  </div>
					</div>
		        </div>
		    </div>
		</div>
		<hr>
    </div>    	  
    </main>
    <!--End 页面主要内容-->


<?php
include 'footer.php';
?>