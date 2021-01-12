<?php
$li2 = 'open active';
$li22 = 'active';
$plugin_name = '我们';
include 'head.php';
include 'list.php';

?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header"><h4>We</h4></div>
              <div class="card-body">
 
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                  <li class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab">项目</a></li>
                  <li><a href="#profile" role="tab" id="profile-tab" data-toggle="tab">作者</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane fade active in" id="home">
				  <br>
				  <img src="./assets/images/logo.png">
					<p><br>自从几年前看过一点PHP后，就陆陆续续写了一些网页小工具(功能)，久而久之，愈发难以统一管理，遂有了本项目。本项目命名为[Daen创意站][DaenCreativeCloud]，UI使用的笔下光年的<a href="https://gitee.com/yinqi/Light-Year-Admin-Template">Light-Year-Admin</a><br><br>
					本项目是一套可以统一管理应用的框架，你可以将自己开发的单页or多页应用(工具？)放到本框架上进行统一管理，本框架提供了数据统计、功能限制等功能<br><br>
					您可以在管理后台中设置某些应用需要用户登录后才能使用，你还可以在管理后台中查看全部或者单个应用的数据统计情况，也可以管理用户、管理留言等<br><br><br>
					演示地址：<a href="https://dcc.pro.daenx.cn">https://dcc.pro.daenx.cn</a><br>
					后台地址：/admin  账号密码：admin/123456<br>
					项目地址：https://gitee.com/daenmax/DaenCreativeCloud<br>
					项目地址：https://github.com/daenmax/DaenCreativeCloud<br>
					</p>
                  </div>
                  <div class="tab-pane fade" id="profile">
                    <p>Daen，中文意为大恩，擅长Java、Php、C#等<br>
					喜欢捣鼓新奇的东西，喜欢听歌，喜欢旅行，还喜欢你<br><br>
					QQ：1330166565<br>
					个人主页：<a href="https://www.daenx.cn">https://www.daenx.cn</a><br>
					Github：<a href="https://github.com/daenmax">https://github.com/daenmax</a><br>
					Gitee：<a href="https://gitee.com/daenmax">https://gitee.com/daenmax</a><br>
					Weibo：<a href="https://weibo.com/u/5900928161">https://weibo.com/u/5900928161</a><br>
					Blog：<a href="https://www.jianshu.com/u/e4ef0d518bba">https://www.jianshu.com/u/e4ef0d518bba</a><br>
					</p>
                  </div>
                </div>
                
              </div>
            </div>
          </div> 
		  </div> 
		  </div> 
    </main>
    <!--End 页面主要内容-->


<?php
include 'footer.php';
?>