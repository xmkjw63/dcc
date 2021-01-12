<?php
$li3 = 'open active';
$li31 = 'active';
$liname = '用户管理';
include 'head.php';
include 'list.php';
$action = $_GET['action'];
if($action=='do'){
	$rs=$DB->query("delete FROM ".constant("TABLE")."user WHERE uid='".$_GET['uid']."'");
	$num = $DB->affected($rs);
	if($num){
		echo "<script>Daen_notify('success','用户删除成功');</script>";
	}else{		
		echo "<script>Daen_notify('error','用户删除失败');</script>";
	}	
}
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <div class="row">
		<div class="col-lg-12">
				<div class="card">
				<div class="card-header">
				<h4><? echo $liname;?></h4>
				</div>
				<div class="card-body">
				<div class="table-responsive">
				<table class="table table-hover">
				<thead>
				<tr>
				<th>UID</th>
				<th>账号</th>
				<th>QQ</th>
				<th>密码</th>
				<th>注册时间</th>
				<th>最后登录</th>
				<th>用户状态</th>
				<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."user WHERE 1");
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

				?>
				<?php
				$rs=$DB->query("SELECT * FROM ".constant("TABLE")."user WHERE 1 ORDER BY `uid` DESC limit $offset,$page_size");
				while($res = $DB->fetch($rs))
				{
					echo '
					<td>'.$res['uid'].'</td>
					<td>'.$res['user'].'</td>
					<td>'.$res['qq'].'</td>
					<td>'.$res['pass'].'</td>
					<td>'.date('Y-m-d H:i:s', $res['addtime']).'</td>
					<td>'.date('Y-m-d H:i:s', $res['updtime']).'</td>
					';
					$status_chk = ($res['status']==1)?'checked':"";
					echo '
					<td><label class="lyear-switch switch-primary"><input type="checkbox" '. $status_chk.' disabled><span></span></label></td>
					<td>
					  <div class="btn-group">
						<a class="btn btn-xs btn-default" href="./user_cha.php?uid='.$res['uid'].'&page='.$page.'" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
						<a class="btn btn-xs btn-default" title="删除" data-toggle="tooltip" href="javascript:void(0);" onclick="user_del('.$res['uid'].')"><i class="mdi mdi-window-close"></i></a>
					  </div>
					</td>
					</tr>';
				}
				?>
				 
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				<center>
				<?php
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
				?>
		      </div>
		    </div>
		  </div>
		</div>
      </div>    
    </main>
    <!--End 页面主要内容-->
<script>
function user_del(uid) {	
	Daen_confirm('info','叮叮','确认删除此用户吗？',true,'user_man.php?action=do&uid='+uid);
}
</script>

<?php
include 'footer.php';
?>