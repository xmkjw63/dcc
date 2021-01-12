<?php
$li2 = 'open active';
$li21 = 'active';
$plugin_name = '留言';
include 'head.php';
include 'list.php';
if($userislogin != 1){
	echo "<script>Daen_confirm('error','啊哦','留言需要先登录哦~<br>即将为您跳转~',true,'./login.php');</script>";
	return;
}
if($system['msg_status']==0){
	$div_disabled='disabled="disabled"';
	echo "<script>Daen_confirm('error','啊哦','系统暂未开启留言功能');</script>";
}
if($system['msg_open']==0){
	$div_hidden = 'hidden';
}
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <div class="row">
			<div class="col-md-12" >
			
				<div class="card" id="div_login">
				  <div class="card-header" id="card_title"><h4>留言</h4></div>
				  <div class="card-body">
					  <div class="lyear-login">
						<div class="login-center">
						<form action="./msg.php" method="POST" >
							<div class="form-group" hidden>
							  <label class="">UID</label>
							  <input type="text" value='<?php echo $uid?>' class="form-control" name="user_uid" id="user_uid" required />
							</div>
							<div class="form-group" id="div_plg_popupcontent">
							  <label class="">留言内容</label>
							  <textarea class="form-control" id="msg" name="msg" rows="6" placeholder="" <?php echo $div_disabled;?>></textarea>
							</div>
							<div class="form-group">
							  <button class="btn btn-block btn-primary" type="submit" id="msg_btn" <?php echo $div_disabled;?>>提交</button>
							</div>
						</form>						  
						</div>
					  </div>
					</div>
		        </div>
				
				<div class="card" <?php echo $div_hidden?>>
				<div class="card-header">
				<h4>留言展示</h4>
				</div>
				<div class="card-body">
				<div class="table-responsive">
				<table class="table table-hover">
				<thead>
				<tr>
				<th>MID</th>
				<th>用户UID</th>
				<th>留言时间</th>
				<th>留言内容</th>
				</tr>
				</thead>
				<tbody>
				<?php
				if($system['msg_open']==1){
					$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."msg WHERE 1");
					$res = $DB->fetch($rs);
					$data_count = $res['count(*)'];

				$page = $_GET["page"];
				if($page == ""){$page = 1;} 
				$page_size = 10; //每页多少条数据
				$page_max = 5; //最多显示多少个页码
				$page_count = ceil($data_count / $page_size);
				$offset = ($page-1) * $page_size;
				$_start = $page - floor($page_max / 2); //计算开始页
				$_start = $_start < 1 ? 1 : $_start;
				$_end = $page + floor($page_max / 2); //计算结束页
				$_end = $_end > $page_count? $page_count : $_end;
				$_curPageNum = $_end - $_start + 1;
				// 调整左边
				if($_curPageNum < $page_max && $_start > 1){
					 $_start = $_start - ($page_max - $_curPageNum);
					 $_start = $_start < 1 ? 1 : $_start;
					 $_curPageNum = $_end - $_start + 1;
				}
				// 调整右边
				if($_curPageNum < $page_max && $_end < $page_count){
					 $_end = $_end + ($page_max - $_curPageNum);
					 $_end = $_end > $page_count? $page_count : $_end;
				}
				}
				

				?>
				<?php
				if($system['msg_open']==1){
					$rs=$DB->query("SELECT * FROM ".constant("TABLE")."msg WHERE 1 ORDER BY `mid` DESC limit $offset,$page_size");
					while($res = $DB->fetch($rs))
					{
					echo '
					<td>'.$res['mid'].'</td>
					<td>'.$res['uid'].'</td>
					<td>'.date('Y-m-d H:i:s', $res['time']).'</td>
					<td>'.$res['text'].'</td>
					</tr>';
					}
				}
				
				?>
				 
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				<center>
				<?php
				if($system['msg_open']==1){
					echo'<ul class="pagination">';
					if($page != 1){
						echo "<li ><a href=?page=1>首页</a></li>";
						echo "<li ><a href=?page=".($page-1).">&laquo;</a></li>";
					}else{
						echo '<li class="disabled"><a>首页</a></li>';
						echo '<li class="disabled"><a>&laquo;</a></li>';
					}
					for ($i = $_start; $i <= $_end; $i++){
						 if($i == $page){
							 echo '<li class="active"><a>'.$i.'</a></li>';
						 }else{
							 echo '<li ><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
						 }
					}
					if($page < $page_count){
						 echo "<li ><a href=?page=".($page + 1).">&raquo;</a></li>";
						 echo "<li ><a href=?page=".$page_count.">尾页</a></li>";
					}else{
						echo '<li class="disabled"><a>&raquo;</a></li>';
						echo '<li class="disabled"><a>尾页</a></li>';
					}	 
					echo'</ul>';
				}
				
				?>
		      </div>
		    </div>

				
		    </div>
		</div>
    </div>       
    </main>
    <!--End 页面主要内容-->
<script>
$(document).ready(function(){
	$('#msg_btn').click(function(){
		var self = $(this);
		var msg = trim($('#msg').val());
		var user_uid = trim($('#user_uid').val());
		if(msg == '') {
			Daen_notify('warning','请填写完整留言内容哦');
			return false;
		}
		if(user_uid == '') {
			Daen_notify('warning','获取用户UID失败，请联系管理员');
			return false;
		}
		$('#msg_btn').attr('do','submit');	
	});
});
</script>
<?php
if(!empty($_POST['msg']) && !empty($_POST['user_uid'])){
	if($system['msg_status']==0){
		echo "<script>Daen_confirm('error','啊哦','系统未开放留言功能');</script>";
	}else{
		$msg=daddslashes($_POST['msg']);
		$data = array(
			"uid"=>$_POST['user_uid'],
			"time"=>time(),
			"text"=>$_POST['msg']
		);
		$rs=$DB->insert_array(constant("TABLE")."msg",$data);
		$num = $DB->affected($rs);
		if($num){
			echo "<script>Daen_confirm('success','叮叮','提交留言成功',true,'msg.php');</script>";
		}else{
			echo "<script>Daen_confirm('error','啊哦','提交留言失败');</script>";
		}
	}
    
}
?>
<?php
include 'footer.php';
?>