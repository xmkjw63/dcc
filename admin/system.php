<?php
$li5 = 'open active';
$li51 = 'active';
$liname = '系统设置';
include 'head.php';
include 'list.php';
?>

<?php
$uid = $_GET['uid'];
$action = $_GET['action'];
if($system['status']==1){
	$status11 = ' selected = "selected"';
}else{
	$status10 = ' selected = "selected"';
}
if($system['user_status']==1){
	$status21 = ' selected = "selected"';
}else{
	$status20 = ' selected = "selected"';
}
if($system['index_status']==1){
	$status31 = ' selected = "selected"';
	$index_content = '';
}else{
	$status30 = ' selected = "selected"';
	$index_content = 'hidden';
}
if($system['msg_status']==1){
	$status41 = ' selected = "selected"';
}else{
	$status40 = ' selected = "selected"';
}
if($system['msg_open']==1){
	$status51 = ' selected = "selected"';
}else{
	$status50 = ' selected = "selected"';
}
if($action=='config'){
	$data = array(
		"title"=>$_POST['title'],
		"keywords"=>$_POST['keywords'],
		"description"=>$_POST['description'],
		"admin_name"=>$_POST['admin_name'],
		"admin_qq"=>$_POST['admin_qq'],
		"copyright"=>$_POST['copyright'],
		"status"=>$_POST['status'],
		"webdata"=>$_POST['webdata']
	); 
	$sql="UPDATE ".constant("TABLE")."system SET title='".$data['title']."',keywords='".$data['keywords']."',description='".$data['description']."',admin_name='".$data['admin_name']."',admin_qq='".$data['admin_qq']."',copyright='".$data['copyright']."',status='".$data['status']."',webdata='".$data['webdata']."' WHERE id='1'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','网站信息修改成功',true,'system.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','网站信息修改失败<br>可能是因为您没有作任何修改',true,'system.php');</script>";
	}
}
if($action=='system'){
	$data = array(
		"user_status"=>$_POST['user_status'],
		"index_status"=>$_POST['index_status'],
		"index_content"=>$_POST['index_content'],
		"msg_status"=>$_POST['msg_status'],
		"msg_open"=>$_POST['msg_open']
	); 
	$sql="UPDATE ".constant("TABLE")."system SET user_status='".$data['user_status']."',index_status='".$data['index_status']."',index_content='".$data['index_content']."',msg_status='".$data['msg_status']."',msg_open='".$data['msg_open']."' WHERE id='1'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','系统设置修改成功',true,'system.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','系统设置修改失败<br>可能是因为您没有作任何修改',true,'system.php');</script>";
	}
}
if($action=='info'){
	$data = array(
		"info_status"=>$_POST['info_status'],
		"info_needlogin"=>$_POST['info_needlogin']
	); 
	$sql="UPDATE ".constant("TABLE")."system SET info_status='".$data['info_status']."',info_needlogin='".$data['info_needlogin']."' WHERE id='1'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','提示信息修改成功',true,'system.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','提示信息修改失败<br>可能是因为您没有作任何修改',true,'system.php');</script>";
	}
}
if($action=='link'){
	$data = array(
		"link1"=>$_POST['link1'],
		"link2"=>$_POST['link2'],
		"link3"=>$_POST['link3'],
		"link4"=>$_POST['link4']
	); 
	$sql="UPDATE ".constant("TABLE")."system SET link1='".$data['link1']."',link2='".$data['link2']."',link3='".$data['link3']."',link4='".$data['link4']."' WHERE id='1'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','友链修改成功',true,'system.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','友链修改失败<br>可能是因为您没有作任何修改',true,'system.php');</script>";
	}
}
if($action=='sign'){
	$data = array(
		"sign_vid"=>$_POST['sign_vid'],
		"sign_key"=>$_POST['sign_key']
	); 
	$sql="UPDATE ".constant("TABLE")."system SET sign_vid='".$data['sign_vid']."',sign_key='".$data['sign_key']."' WHERE id='1'";
	$rs=$DB->query($sql);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','vaptcha修改成功',true,'system.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','vaptcha修改失败<br>可能是因为您没有作任何修改',true,'system.php');</script>";
	}
}
?>  
    <!--页面主要内容-->
    <main class="lyear-layout-content"> 
      <div class="container-fluid">
        <div class="row">
			<div class="col-lg-6">
				<div class="card">
				    <div class="card-header" id="card_title"><h4>网站信息</h4></div>
					<div class="card-body">
					  <div class="lyear-add">
						<div class="add-center">
						<form action="system.php?action=config" method="post"  role="form">
						  <div id="add">
						    <div class="form-group">
							  <label class="">网站名称</label>
							  <input type="text" value='<?php echo $system['title']?>' class="form-control" name="title" id="title" required />
							</div>
							<div class="form-group">
							  <label class="">网站关键词</label>
							  <input type="text" value='<?php echo $system['keywords']?>' class="form-control" name="keywords" id="keywords"/>
							</div>
							<div class="form-group">
							  <label class="">网站描述</label>
							  <input type="text" value='<?php echo $system['description']?>' class="form-control" name="description" id="description"/>
							</div>
							<div class="form-group">
							  <label class="">管理员名称</label>
							  <input type="text" value='<?php echo $system['admin_name']?>' class="form-control" name="admin_name" id="admin_name"/>
							</div>
							<div class="form-group">
							  <label class="">管理员QQ</label>
							  <input type="text" value='<?php echo $system['admin_qq']?>' class="form-control" name="admin_qq" id="admin_qq"/>
							</div>
							<div class="form-group">
							  <label class="">备案和版权</label>
							  <input type="text" value='<?php echo $system['copyright']?>' class="form-control" name="copyright" id="copyright"  />
							</div>
							<div class="form-group">
							  <label class="">统计代码</label>
							  <a href="https://tongji.baidu.com/" target="_blank">百度统计</a>
							  <a href="https://web.51.la/" target="_blank">我要啦统计</a>
							  <textarea class="form-control" id="webdata" name="webdata" rows="9" ><?php echo $system['webdata']?></textarea>
							</div>
							<div class="form-group">
							  <label class="">网站状态</label>
							    <select class="form-control" id="status" name="status" size="1">
									<option value="1" <?php echo $status11?>>正常</option>
									<option value="0" <?php echo $status10?>>维护</option>
								</select>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-primary" type="submit" id="submit">提交修改</button>
							</div>
						  </div>
						  </form>
						</div>
					  </div>
					</div>
		        </div>
				</div>
				<div class="col-lg-6">
				<div class="card">
					<div class="card-header" id="card_title"><h4>系统设置</h4></div>
					<div class="card-body">
					  <div class="lyear-add">
						<div class="add-center">
						<form action="system.php?action=system" method="post"  role="form">
						  <div id="add">
							<div class="form-group">
							  <label class="">注册开关</label>
							    <select class="form-control" id="user_status" name="user_status" size="1">
									<option value="1" <?php echo $status21?>>开放</option>
									<option value="0" <?php echo $status20?>>禁止</option>
								</select>
							</div>
							<div class="form-group">
							  <label class="">首页弹窗</label>
							    <select class="form-control" id="index_status" name="index_status" size="1" onclick="selectChange()">
									<option value="1" <?php echo $status31?>>是</option>
									<option value="0" <?php echo $status30?>>否</option>
								</select>
							</div>
							<div class="form-group" id="div_index_content" <?php echo $index_content?>>
							  <label class="">弹窗内容 支持HTML</label>
							  <textarea class="form-control" id="index_content" name="index_content" rows="5" ><?php echo $system['index_content']?></textarea>
							</div>
							<div class="form-group">
							  <label class="">留言开关</label>
							    <select class="form-control" id="msg_status" name="msg_status" size="1">
									<option value="1" <?php echo $status41?>>开放</option>
									<option value="0" <?php echo $status40?>>禁止</option>
								</select>
							</div>
							<div class="form-group">
							  <label class="">留言展示</label>
							    <select class="form-control" id="msg_open" name="msg_open" size="1">
									<option value="1" <?php echo $status51?>>是</option>
									<option value="0" <?php echo $status50?>>否</option>
								</select>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-info" type="submit" id="submit">提交修改</button>
							</div>
						  </div>
						  </form> 
						</div>
					  </div>
					</div>
		        </div>
				</div>
				<div class="col-lg-6">
				<div class="card">
					<div class="card-header" id="card_title"><h4>vaptcha手势验证 <a href="https://www.vaptcha.com/" target="_blank">免费申请：Vaptcha官网</a></h4></div>
					<div class="card-body">
					  <div class="lyear-add">
						<div class="add-center">
						<form action="system.php?action=sign" method="post"  role="form">
						  <div id="add">
							<div class="form-group">
							  <label class="">vid</label>
							  <input type="text" value='<?php echo $system['sign_vid']?>' class="form-control" name="sign_vid" id="sign_vid"/>
							</div>
							<div class="form-group">
							  <label class="">key</label>
							  <input type="text" value='<?php echo $system['sign_key']?>' class="form-control" name="sign_key" id="sign_key"/>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-warning" type="submit" id="submit">提交修改</button>
							</div>
						  </div>
						  </form> 
						</div>
					  </div>
					</div>
		        </div>
				
				
				</div>
				</div>
				<div class="row">
				<div class="col-lg-6">
				<div class="card">
					<div class="card-header" id="card_title"><h4>友情链接 名字+空格+URL</h4></div>
					<div class="card-body">
					  <div class="lyear-add">
						<div class="add-center">
						<form action="system.php?action=link" method="post"  role="form">
						  <div id="add">
							<div class="form-group">
							  <label class="">link1</label>
							  <input type="text" value='<?php echo $system['link1']?>' class="form-control" name="link1" id="link1"/>
							</div>
							<div class="form-group">
							  <label class="">link2</label>
							  <input type="text" value='<?php echo $system['link2']?>' class="form-control" name="link2" id="link2"/>
							</div>
							<div class="form-group">
							  <label class="">link3</label>
							  <input type="text" value='<?php echo $system['link3']?>' class="form-control" name="link3" id="link3"/>
							</div>
							<div class="form-group">
							  <label class="">link4</label>
							  <input type="text" value='<?php echo $system['link4']?>' class="form-control" name="link4" id="link4"/>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-dark" type="submit" id="submit">提交修改</button>
							</div>
						  </div>
						  </form> 
						</div>
					  </div>
					</div>
		        </div>
				</div>
				<div class="col-lg-6">
				<div class="card">
					<div class="card-header" id="card_title"><h4>提示信息</h4></div>
					<div class="card-body">
					  <div class="lyear-add">
						<div class="add-center">
						<form action="system.php?action=info" method="post"  role="form">
						  <div id="add">
							<div class="form-group">
							  <label class="">应用维护中 支持HTML</label>
							  <textarea class="form-control" id="info_status" name="info_status" rows="5" ><?php echo $system['info_status']?></textarea>
							</div>
							<div class="form-group">
							  <label class="">需要登录 支持HTML</label>
							  <textarea class="form-control" id="info_needlogin" name="info_needlogin" rows="5" ><?php echo $system['info_needlogin']?></textarea>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-purple" type="submit" id="submit">提交修改</button>
							</div>
						  </div>
						  </form> 
						</div>
					  </div>
					</div>
		        </div>
				
				</div></div>				
		    </div>
		</div>
		<hr>

    </div>    
	  
    </main>
    <!--End 页面主要内容-->
<script>
function selectChange() {	
	$("select[id='index_status']").change(function(){
		var selected=$(this).children('option:selected').val()
		if(selected=="1"){
			  $("div[id='div_index_content']").show();
		}else if(selected=="0"){
			$("div[id='div_index_content']").hide();
		}
	});
}
</script>

<?php
include 'footer.php';
?>