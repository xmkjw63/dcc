<?php
$li3 = 'open active';
$li31 = 'active';
$liname = '用户修改';
include 'head.php';
include 'list.php';
?>
<?php
$uid = $_GET['uid'];
$page = $_GET['page'];
$action = $_GET['action'];
if($uid == "" && $action==""){
	exit("<script language='javascript'>window.location.href='./user_man.php?page=".$page."';</script>");
}
$rs=$DB->query("SELECT * FROM ".constant("TABLE")."user WHERE uid=".$uid);
$res = $DB->fetch($rs);
$data = array(
		"uid"=>$res['uid'],
		"user"=>$res['user'],
		"pass"=>$res['pass'],
		"addtime"=>$res['addtime'],
		"updtime"=>$res['updtime'],
		"qq"=>$res['qq'],
		"status"=>$res['status']
	);
if($data['uid'] == "" && $action == ""){
	exit("<script>Daen_confirm('error','啊哦','用户不存在',true,'./user_man.php?page=".$page."');</script>");
}else{
	if($data['status']==1){
		$status1 = ' selected = "selected"';
	}else{
		$status0 = ' selected = "selected"';
	}
}
if($action=='do'){
	$data = array(
		"uid"=>$_POST['user_uid'],
		"user"=>$_POST['user_user'],
		"pass"=>$_POST['user_pass'],
		"addtime"=>strtotime($_POST['user_addtime']),
		"qq"=>$_POST['user_qq'],
		"status"=>$_POST['user_status']
	); 
	$sql="UPDATE ".constant("TABLE")."user SET user='".$data['user']."',pass='".$data['pass']."',addtime='".$data['addtime']."',qq='".$data['qq']."',status='".$data['status']."' WHERE uid='".$data['uid']."'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','用户修改成功',true,'user_man.php?page=".$page."');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','用户修改失败',true,'user_man.php?page=".$page."');</script>";
	}
}
?>  
<!--时间选择插件-->
<link rel="stylesheet" href="../assets/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">  
    <!--页面主要内容-->
    <main class="lyear-layout-content">      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" id="card_title"><h4><?php echo $data['user']?></h4></div>
					<div class="card-body">		
					  <div class="lyear-add">
						<div class="add-center">
						<form action="user_cha.php?action=do&page=<?=$page?>" method="post"  role="form">
						  <div id="add">
						    <div class="form-group" hidden>
							  <label class="">UID</label>
							  <input type="text" value='<?php echo $data['uid']?>' class="form-control" name="user_uid" id="user_uid" required />
							</div>
							<div class="form-group">
							  <label class="">账号</label>
							  <input type="text" value='<?php echo $data['user']?>' class="form-control" name="user_user" id="user_user" required />
							</div>
							<div class="form-group">
							  <label class="">密码</label>
							  <input type="text" value='<?php echo $data['pass']?>' class="form-control" name="user_pass" id="user_pass" required />
							</div>
							<div class="form-group">
							  <label class="">QQ</label>
							  <input type="text" value='<?php echo $data['qq']?>' class="form-control" name="user_qq" id="user_qq" required />
							</div>
							<div class="form-group">
							  <label class="">注册时间</label>							 
							  <input class="form-control js-datetimepicker" type="text" id="user_addtime" name="user_addtime" placeholder="请选择具体时间" value="<?php echo date('Y-m-d H:i:s', $data['addtime'])?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm" />
							</div>
							<div class="form-group">
							  <label class="">用户状态</label>
							    <select class="form-control" id="user_status" name="user_status" size="1">
									<option value="1" <?php echo $status1?>>正常</option>
									<option value="0" <?php echo $status0?>>禁用</option>
								</select>
							</div>

							<div class="form-group">
							  <button class="btn btn-block btn-primary" type="submit" id="submit">修改</button>
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


<!--时间选择插件-->
<script src="../assets/js/bootstrap-datetimepicker/moment.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>
<!--日期选择插件-->
<script src="../assets/js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<?php
include 'footer.php';
?>