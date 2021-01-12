<?php
$li2 = 'open active';
$li21 = 'active';
$liname = '应用修改';
include 'head.php';
include 'list.php';
?>
<?php
$pid = $_GET['pid'];
$page = $_GET['page'];
$action = $_GET['action'];
if($pid == "" && $action == ""){
	exit("<script language='javascript'>window.location.href='./plugin_man.php?page=".$page."';</script>");
}
$rs=$DB->query("SELECT * FROM ".constant("TABLE")."plugin WHERE pid=".$pid);
$res = $DB->fetch($rs);
$data = array(
		"pid"=>$res['pid'],
		"id"=>$res['id'],
		"name"=>$res['name'],
		"addtime"=>$res['addtime'],
		"author"=>$res['author'],
		"authorlink"=>$res['authorlink'],
		"status"=>$res['status'],
		"needlogin"=>$res['needlogin'],
		"popup"=>$res['popup'],
		"popup_content"=>$res['popup_content'],
		"sign"=>$res['sign']
	);
if($data['pid'] == "" && $action == ""){
	exit("<script>Daen_confirm('error','啊哦','应用不存在',true,'./plugin_man.php?page=".$page."');</script>");
}else{
	if($data['needlogin']==1){
		$needlogin1 = ' selected = "selected"';
	}else{
		$needlogin0 = ' selected = "selected"';
	}
	if($data['status']==1){
		$status1 = ' selected = "selected"';
	}else{
		$status0 = ' selected = "selected"';
	}
	if($data['popup']==1){
		$popup1 = ' selected = "selected"';
		$popup_content = '';
	}else{
		$popup0 = ' selected = "selected"';
		$popup_content = 'hidden';
	}
	if($data['sign']==1){
		$sign1 = ' selected = "selected"';
	}else{
		$sign0 = ' selected = "selected"';
	}
}

if($action=='do'){
	$data = array(
		"pid"=>$_POST['plg_pid'],
		"id"=>$_POST['plg_id'],
		"name"=>$_POST['plg_name'],
		"addtime"=>strtotime($_POST['plg_addtime']),
		"author"=>$_POST['plg_author'],
		"authorlink"=>$_POST['plg_authorlink'],
		"status"=>$_POST['plg_status'],
		"needlogin"=>$_POST['plg_needlogin'],
		"popup"=>$_POST['plg_popup'],
		"popup_content"=>$_POST['plg_popupcontent'],
		"sign"=>$_POST['plg_sign']
	); 
	$sql="UPDATE ".constant("TABLE")."plugin SET id='".$data['id']."',name='".$data['name']."',addtime='".$data['addtime']."',author='".$data['author']."',authorlink='".$data['authorlink']."',status='".$data['status']."',needlogin='".$data['needlogin']."',popup='".$data['popup']."',popup_content='".$data['popup_content']."',sign='".$data['sign']."' WHERE pid='".$data['pid']."'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','应用修改成功',true,'plugin_man.php?page=".$page."');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','应用修改失败<br>可能是您没有做任何修改',true,'plugin_man.php?page=".$page."');</script>";
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
					<div class="card-header" id="card_title"><h4><?php echo $data['name']?></h4></div>
					<div class="card-body">
		
					  <div class="lyear-add">
						<div class="add-center">
						<form action="plugin_cha.php?action=do&page=<?=$page?>" method="post"  role="form">
						  <div id="add">
						    <div class="form-group" hidden>
							  <label class="">PID</label>
							  <input type="text" value='<?php echo $data['pid']?>' class="form-control" name="plg_pid" id="plg_pid" required />
							</div>
							<div class="form-group">
							  <label class="">应用ID</label>
							  <input type="text" value='<?php echo $data['id']?>' class="form-control" name="plg_id" id="plg_id" required />
							</div>
							<div class="form-group">
							  <label class="">应用名称</label>
							  <input type="text" value='<?php echo $data['name']?>' class="form-control" name="plg_name" id="plg_name" required />
							</div>
							<div class="form-group">
							  <label class="">添加时间</label>
							 
							  <input class="form-control js-datetimepicker" type="text" id="plg_addtime" name="plg_addtime" placeholder="请选择具体时间" value="<?php echo date('Y-m-d H:i:s', $data['addtime'])?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm" />
							</div>
							<div class="form-group">
							  <label class="">作者</label>
							  <input type="text" value='<?php echo $data['author']?>' class="form-control" name="plg_author" id="plg_author" required />
							  
							</div>
							<div class="form-group">
							  <label class="">联系方式</label>
							  <input type="text" value='<?php echo $data['authorlink']?>' class="form-control" name="plg_authorlink" id="plg_authorlink" required />
							  
							</div>
							<div class="form-group">
							  <label class="">是否需要登录</label>
							  <select class="form-control" id="plg_needlogin" name="plg_needlogin" size="1">
									<option value="0" <?php echo $needlogin0?>>否</option>
									<option value="1" <?php echo $needlogin1?>>是</option>
							  </select>
							</div>
							<div class="form-group">
							  <label class="">是否弹窗</label>
							  <select class="form-control" id="plg_popup" name="plg_popup" size="1" onclick="selectChange()">
									<option value="0" <?php echo $popup0?>>否</option>
									<option value="1" <?php echo $popup1?>>是</option>
							  </select>
							</div>
							<div class="form-group" id="div_plg_popupcontent" <?php echo $popup_content?>>
							  <label class="">弹窗内容 支持HTML</label>
							  <textarea class="form-control" id="plg_popupcontent" name="plg_popupcontent" rows="6" ><?php echo $data['popup_content']?></textarea>
							</div>
							<div class="form-group">
							  <label class="">是否需要验证码</label>
							  <select class="form-control" id="plg_sign" name="plg_sign" size="1">
									<option value="0" <?php echo $sign0?>>否</option>
									<option value="1" <?php echo $sign1?>>是</option>
							  </select>
							</div>
							<div class="form-group">
							  <label class="">应用状态</label>
							    <select class="form-control" id="plg_status" name="plg_status" size="1">
									<option value="1" <?php echo $status1?>>启用</option>
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
<script>
function selectChange() {	
	$("select[id='plg_popup']").change(function(){
		var selected=$(this).children('option:selected').val()
		if(selected=="1"){
			  $("div[id='div_plg_popupcontent']").show();
		}else if(selected=="0"){
			$("div[id='div_plg_popupcontent']").hide();
		}
	});
}
</script>

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