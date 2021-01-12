<?php
$li2 = 'open active';
$li22 = 'active';
$liname = '应用添加';
include 'head.php';
include 'list.php';
?>
<?php
$action = $_GET['action'];
if($action=='do'){
	$data = array(
		"id"=>$_POST['plg_id'],
		"name"=>$_POST['plg_name'],
		"addtime"=>time(),
		"author"=>$_POST['plg_author'],
		"authorlink"=>$_POST['plg_authorlink'],
		"status"=>$_POST['plg_status'],
		"needlogin"=>$_POST['plg_needlogin'],
		"popup"=>$_POST['plg_popup'],
		"popup_content"=>$_POST['plg_popupcontent'],
		"sign"=>$_POST['plg_sign']
	);
	$rs=$DB->insert_array(constant("TABLE")."plugin",$data);
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_confirm('success','叮叮','应用添加成功',true,'plugin_man.php');</script>";
	}else{
		echo "<script>Daen_confirm('error','啊哦','应用添加失败');</script>";
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
						<form action="plugin_add.php?action=do" method="post"  role="form">
						  <div id="add">
						  
							<div class="form-group">
							  <label class="">应用ID</label>
							  <input type="text" placeholder="请输入应用ID" class="form-control" name="plg_id" id="plg_id" required />
							</div>
							<div class="form-group">
							  <label class="">应用名称</label>
							  <input type="text" placeholder="请输入应用名称" class="form-control" name="plg_name" id="plg_name" required />
							  
							</div>
							<div class="form-group">
							  <label class="">作者</label>
							  <input type="text" placeholder="请输入作者" class="form-control" name="plg_author" id="plg_author" required />
							  
							</div>
							<div class="form-group">
							  <label class="">联系方式</label>
							  <input type="text" placeholder="请输入联系方式" class="form-control" name="plg_authorlink" id="plg_authorlink" required />
							  
							</div>
							<div class="form-group">
							  <label class="">是否需要登录</label>
							  <select class="form-control" id="plg_needlogin" name="plg_needlogin" size="1">
									<option value="0">否</option>
									<option value="1">是</option>
							  </select>
							</div>
							<div class="form-group" id="div_plg_popup">
							  <label class="">是否弹窗</label>
							  <select class="form-control" id="plg_popup" name="plg_popup" size="1" onclick="selectChange()">
									<option value="1">是</option>
									<option value="0">否</option>
							  </select>
							</div>
							<div class="form-group" id="div_plg_popupcontent">
							  <label class="">弹窗内容 支持HTML</label>
							  <textarea class="form-control" id="plg_popupcontent" name="plg_popupcontent" rows="6" placeholder="弹窗内容，支持HTML" ></textarea>
							</div>
							<div class="form-group" id="div_plg_popup">
							  <label class="">是否需要验证</label>
							  <select class="form-control" id="plg_sign" name="plg_sign" size="1" onclick="selectChange()">
									<option value="1">是</option>
									<option value="0">否</option>
							  </select>
							</div>
							<div class="form-group">
							  <label class="">应用状态</label>
							    <select class="form-control" id="plg_status" name="plg_status" size="1">
									<option value="1">启用</option>
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

<?php
include 'footer.php';
?>