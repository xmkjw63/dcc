<?php
/**
	1.请填写应用ID和应用名称
	2.此文件名必须为应用ID.php
	↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
*/
$plugin_id = 'shorturl';
$plugin_name = '短网址';
/**
	↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
	配置此应用信息到此位置结束
*/
include './plugin_head.php';
?>   
<div class="col-md-12">
	<div class="card">
		<div class="card-header" id="card_title"><h4>缩短还原</h4></div>
		<div class="card-body">		
		  <div class="lyear-login">
			<div class="login-center">
			  <div id="long">
				<div class="form-group has-feedback feedback-left">
				  <input type="text" placeholder="请输入相应的网址" class="form-control  btn-round" name="inputurl" id="inputurl"  onkeydown="if(event.keyCode==13){submit.click()}" <?php echo $div_disabled;?>/>
				  <span class="mdi mdi-share-variant form-control-feedback" aria-hidden="true"></span>
				</div>
				<?php if($plugin['sign']==1){include './sign.php';}?>
				<div class="form-group">
				  <button class="btn btn-block btn-primary btn-round" type="button" id="submit_short" <?php echo $div_disabled;?>>缩短</button>
				</div>
				<div class="form-group">
				  <button class="btn btn-block btn-info btn-round" type="button" id="submit_long" <?php echo $div_disabled;?>>还原</button>
				</div>
			  </div>						  
			  <div id="result">
				<div class="form-group has-feedback feedback-left">
				  <input type="text" placeholder="" class="form-control" name="url" id="url" disabled="disabled"/>
				  <span class="mdi mdi-shield-half-full form-control-feedback" aria-hidden="true"></span>
				</div>
			  </div>						  	 						  
			</div>
		  </div>
		</div>
	</div>
</div>
<script>
var api_url = '../data/api/<?=$plugin_id?>.php';//API地址

//定义方法
function longurl(url){//还原
	lightyear.loading('show');
	var data = {url: url,token: typeof token=='undefined'?'':token};
		$.post(api_url+"?do=longurl", data, function (r) {
			  lightyear.loading('hide'); 
			  if (r.status == 0) {
				  Daen_notify('error',r.msg);
				  return;
			  }
			  if(r.code == 1){
				  $('#result').show();
				  $('#url').val("原网址： "+r.data.dwzreduction);
				  Daen_confirm('success',"还原成功",r.data.dwzreduction);
			  }else{
				  Daen_notify('error',r.msg);
			  }
	},"json");
}
function shorturl(url){//缩短
	lightyear.loading('show');
	var data = {url: url,token: typeof token=='undefined'?'':token};
		$.post(api_url+"?do=shorturl", data, function (r) {
			  lightyear.loading('hide'); 
			  if (r.status == 0) {
				  Daen_notify('error',r.msg);
				  return;
			  }
			  if(r.code == 1){
				  $('#result').show();
				  $('#url').val("短网址： "+r.url.url_short);
				  Daen_confirm('success',"缩短成功",r.url.url_short);
			  }else{
				  Daen_notify('error',r.msg);
			  }
	},"json");
}
function init(){//初始化应用页面
	$("#result").hide();
}

//注册事件
$(document).ready(function(){//入口
	init();
	$('#submit_short').click(function(){
		var self = $(this);
		var inputurl = trim($('#inputurl').val());
		if(inputurl == '') {
			Daen_notify('warning','请填写相应的网址哦');
			return false;
		}		
		if(typeof token != 'undefined') {
			if(token==''){
				Daen_notify('warning','请进行人机验证哦');
				return false;
			}       
        }
		shorturl(inputurl);
	});
	$('#submit_long').click(function(){
		var self = $(this);
		var inputurl = trim($('#inputurl').val());
		if(inputurl == '') {
			Daen_notify('warning','请填写相应的网址哦');
			return false;
		}
		if(token && token=='') {
            Daen_notify('warning','请进行人机验证哦');
            return false;
        }
		longurl(inputurl);
	});
});
</script>
<?php
include './plugin_footer.php';
?>  