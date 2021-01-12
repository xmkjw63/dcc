<?php
$li1 = 'open active';
$li11 = 'active';
$plugin_name = '应用开发';
include 'head.php';
include 'list.php';
?>    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h4>了解应用</h4>
              </div>
              <div class="card-body">
                <p>
				应用开发采用 HTML -> JS -> AJAX -> API -> JS -> HTML<br>
				<h4>应用目录</h4>
				<blockquote class="blockquote">
                  <p>
				  ./plugin/shorturl.php<cite title=""> //应用主题</cite><br>
				  ./data/api/shorturl.php<cite title=""> //应用API</cite></p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				一个完整的应用需要配置编写2个文件
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
          
          <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-success">
                <h4>应用界面</h4>
              </div>
              <div class="card-body">
                <p>
				在./plugin中找到(复制新建)以应用ID命名的PHP文件
				<blockquote class="blockquote">
                  <p>
				  $plugin_id = 'shorturl';<cite title=""> //这里填写你的应用ID</cite><br>
				  $plugin_name = '短网址';<cite title=""> //这里填写你的应用名称</cite><br><br>
				  //然后就可以开始写界面了<br>
				  需要注意的是，已经为您包含的div如下<br>
<textarea class="form-control" rows="13" ><!--页面主要内容-->
<main class="lyear-layout-content">
	<div class="container-fluid">
		<div class="row">
			<此处才是您在应用中写的界面>					
		</div>
	<hr>
	<footer class="col-sm-12 text-center">
	<p class="m-b-0">应用作者：Daen</p>
	</footer>
	</div>    
</main>
<!--End 页面主要内容--></textarea>
				  </p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				
				<blockquote class="blockquote">
                  <p>
				  接入系统提供的验证码<br>
<textarea class="form-control" rows="2" >
< ?php if($plugin['sign']==1){include './sign.php';}?>
</textarea>
				  </p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
		  
		  <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-info">
                <h4>应用JS</h4>
              </div>
              <div class="card-body">
                <p>
				在您的应用页面下方，您应该写JS<br>
				大体框架思路如下：以shorturl为例
				<blockquote class="blockquote">
                  <p>
				  定义函数和注册事件<br>
<textarea class="form-control" rows="75" >var api_url = '../data/api/<?=$plugin_id?>.php';//API地址

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
});</textarea>
				  </p>
                </blockquote>

				
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
		  
		   <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-purple">
                <h4>应用接口</h4>
              </div>
              <div class="card-body">
                <p>
				在./data中找到(复制新建)以应用ID命名的文件夹，并且打开其中的api.php<br>
				你无需手动加载此文件，框架会自动为您的应用加载
				<blockquote class="blockquote">
                  <p>
				  定义有效指令数组和应用ID<br>
<textarea class="form-control" rows="3" >//定义有效指令数组和应用ID
$requstArr = array("shorturl","longurl");//定义的指令数组
$plugin_id = 'shorturl';//应用ID</textarea>
				  </p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				<blockquote class="blockquote">
                  <p>
				  定义入口<br>
<textarea class="form-control" rows="58" >if(isRight($do,$requstArr)){//判断指令是否正确，如果正确即进入处理
	$api = new API();
	$user_token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
	list($uid,$user,$qq,$session) = explode("\t", $user_token);//解析cookies里的user_token;
	$rs = $DB->query("SELECT * FROM ".constant("TABLE")."plugin WHERE id='".$plugin_id."'");
	$res = $DB->fetch($rs);
	if($res['status']==0){
		$data = array(
		"status"=>0,
		"msg"=>$info['plugin_info'],
		"pg_id"=>$res['id'],
		"pg_name"=>$res['name']
		);
		ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
		echo json_encode($data);
		return;
	}
	if($res['needlogin']==1){
		if($uid==''){
			$data = array(
			"status"=>0,
			"msg"=>$info['login_info'],
			"pg_id"=>$res['id'],
			"pg_name"=>$res['name']
			);
			ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
			echo json_encode($data);
			return;
		}
	}
	if($res['sign']==1){
		if(isVaptcha($system['sign_vid'],$system['sign_key'],$_POST['token'],real_ip())!=true){
			$data = array(
			"status"=>0,
			"msg"=>'token error',
			"pg_id"=>$res['id'],
			"pg_name"=>$res['name']
			);
			ins_log($DB,$res['pid'],$uid,0);//添加应用使用日志：请求失败
			echo json_encode($data);
			return;
		}
	}
	ins_log($DB,$res['pid'],$uid,1);//添加应用使用日志：请求成功
	//请求入口
	switch($do){
		case $requstArr[0]:
			echo $api->shorturl($_POST['url']);
			break;
		case $requstArr[1]:
			echo $api->longurl($_POST['url']);
			break;
		default://此处的default无意义，因为我们在上方已经对指令正确性做了处理，错误的请求指令将不会进入此
			return;
	}
	return;
}</textarea>
				  </p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				<blockquote class="blockquote">
                  <p>
				  定义函数<br>
<textarea class="form-control" rows="18" >//定义函数
class API{
	//这里只是一个应用开发例程，所以就套娃调用别人的API做演示了
	public function shorturl($url){//缩短
		$dataurl = 'https://api.oioweb.cn/api/dwz.php?type=2&url='.$url;
		$json = get_curl($dataurl);
		return $json;
		//{"code":1,"msg":"生成成功！","url":{"url_short":"https://url.cn/iS0NMUHH","url_long":"https://blog.oioweb.cn/"}}
	}	
	public function longurl($url){//还原
		$dataurl = 'https://api.oioweb.cn/api/dwzreduction.php?url='.$url;
		$json = get_curl($dataurl);
		return $json;
		//{"code":1,"msg":"获取成功","data":{"dwz":"https://url.cn/zh0tNR7E","dwzreduction":"https://blog.oioweb.cn/"}}
	}	
}</textarea>
				  </p>
                  <footer>以shorturl为例</footer>
                </blockquote>
				
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
		  
		   <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-brown">
                <h4>可用变量</h4>
              </div>
              <div class="card-body">
                <p>
				<h4>开发准备</h4>
				<blockquote class="blockquote">
                  <p>
				  开发中为方便调试，可暂时注释掉<br>
				  ./data/common.php<br>
				  中第一行的抑制错误代码：error_reporting(0);
				  </p>
                </blockquote>
				<h4>全局可用变量</h4>
				<blockquote class="blockquote">
                  <p>
				  $system[]<cite title=""> //系统变量，数组</cite><br>
				  <blockquote class="blockquote">
                  <p>
					'title' => //网站SEO：标题<br>
					'keywords' => //网站SEO：关键词<br>
					'description' => //网站SEO：说明<br>
					'admin_name' => //管理员名字<br>
					'admin_qq' => //管理员QQ<br>
					'status' => //网站状态，是否可用?1:0<br>
					'user_status' => //用户注册开关，是否可注册?1:0<br>
					'index_status' => //首页是否弹窗?1:0<br>
					'msg_status' => //用户留言开关，是否可留言?1:0<br>
					'msg_open' => //用户留言展示，是否展示?1:0<br>
					'copyright' => //版权
				  </p>
                  </blockquote>
				  $info[]<cite title=""> //提示消息内容，数组</cite><br>
				  <blockquote class="blockquote">
                  <p>
					'plugin_info' => //应用不可用提示内容<br>
					'login_info' => //需要登录提示内容<br>
					'index_info' => //首页弹窗内容<br>
				  </p>
                  </blockquote>
				  $link[][]<cite title=""> //友情链接，二维数组，[0][0] - [3][1]</cite>
				  <blockquote class="blockquote">
                  <p>
					友链名称1 友链URL1，<br>
					友链名称2 友链URL2，<br>
					友链名称3 友链URL3，<br>
					友链名称4 友链URL4，
				  </p>
                  </blockquote>
				  $DB<cite title=""> //数据库操作</cite><br>
				  </p>
                </blockquote>
				<h4>应用可用变量</h4>
				<blockquote class="blockquote">
                  <p>
				  $div_disabled<cite title=""> //禁止，HTML属性，仅在应用维护时不为空</cite><br>
				  $div_hidden<cite title=""> //隐藏，HTML属性，仅在应用维护时不为空</cite><br>
				  $plugin[]<cite title=""> //应用信息，数组</cite><br>
				  <blockquote class="blockquote">
                  <p>
				    'id' => $res['id'],//应用ID<br>
					'name' => //应用名称<br>
					'addtime' => //添加时间<br>
					'author' => //应用作者<br>
					'authorlink' => //联系方式<br>
					'status' => //应用状态，是否可用?1:0<br>
					'needlogin' => //是否需要登录?1:0<br>
					'popup' => //是否弹窗?1:0<br>
					'popup_content' => //弹窗内容<br>
					'sign' => //是否需要验证码?1:0
				  </p>
                </blockquote>
				  $userislogin<cite title=""> //用户是否已登录?1:0</cite>
				  </p>
                </blockquote>
				
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
		   <div class="col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h4>可用函数</h4>
              </div>
              <div class="card-body">
                <p>
				下面是封装好的一些函数，您可以直接使用<br>
				<h4>JS</h4>
				<blockquote class="blockquote">
                  <p>
				  trim(str)<cite title=""> //去掉头尾空格</cite><br>
				  Daen_confirm(type,title,content,jump,url)<cite title=""> //封装好的弹窗</cite><br>
					<blockquote class="blockquote">
					  <p>
						'type' => success、error、warning、info<br>
						'title' => 标题<br>
						'content' => 弹窗内容<br>
						'jump' => true,false//是否跳转，可空<br>
						'url' => //跳转地址，可空，若跳转，此处留空，则返回上一页
					  </p>
					</blockquote>
				 Daen_notify(type,content)<cite title=""> //封装好的提示</cite><br>
					<blockquote class="blockquote">
					  <p>
						'type' => success、error、warning、info<br>
						'content' => 提示内容
					  </p>
					</blockquote>
				Daen_jump_notify(url)<cite title=""> //封装好的跳转</cite><br>
                </blockquote>
				<h4>PHP</h4>
				<blockquote class="blockquote">
                  <p>
				  get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0)<cite title=""> //GET\POST网络请求</cite><br>
				  curl_get($url)<cite title=""> //简易GET网络请求</cite><br>
				  real_ip()<cite title=""> //获取用户真实IP</cite><br>
				  number($num)<cite title=""> //判断是否为纯数字</cite><br>
				  daddslashes($string, $force = 0, $strip = FALSE)<cite title=""> //在每个双引号（"）前添加反斜杠</cite><br>
				  random($length, $numeric = 0)<cite title=""> //取随机字符串</cite><br>
				  strexists($string, $find)<cite title=""> //取字符串中是否包含指定字符串</cite><br>
				  ins_log($db,$pid,$uid,$status)<cite title=""> //添加应用使用日志</cite><br>
				  isRight($requst,$requstArr)<cite title=""> //判断一个字符串是否存在另一个字符串数组中</cite><br>
                </blockquote>
				</p>
              </div>
            </div>
          </div>
          <!-- .col-sm-6 -->
		  
		  </div> 
      </div>       
    </main>
    <!--End 页面主要内容-->
<?php
include 'footer.php';
?>