<body>
<div class="lyear-layout-web">
  <div class="lyear-layout-container">
    <!--左侧导航-->
    <aside class="lyear-layout-sidebar">  
      <!-- logo -->
      <div id="logo" class="sidebar-header">
        <a href="#"><img src="../assets/images/logo-sidebar.png" title="DaenCreativeCloud" alt="DaenCreativeCloud" /></a>
      </div>
      <div class="lyear-layout-sidebar-scroll">    
        <nav class="sidebar-main">
          <ul class="nav nav-drawer">
            <li class="nav-item <?php echo $li1;?>"> <a href="index.php"><i class="mdi mdi-home-outline"></i> 首页</a> </li>
			
            <li class="nav-item nav-item-has-subnav <?php echo $li2;?>">
              <a href="javascript:void(0)"><i class="mdi mdi-cube-outline"></i>应用</a>
              <ul class="nav nav-subnav">
                <li class="<?php echo $li21;?>"> <a href="plugin_man.php">管理</a> </li>
                <li class="<?php echo $li22;?>"> <a href="plugin_add.php">添加</a> </li>
                <li class="<?php echo $li23;?>"> <a href="plugin_data.php">数据</a> </li>
                <li class="<?php echo $li24;?>"> <a href="plugin_log.php">日志</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav <?php echo $li3;?>">
              <a href="javascript:void(0)"><i class="mdi mdi-account-outline"></i> 用户</a>
              <ul class="nav nav-subnav">
                <li class="<?php echo $li31;?>"> <a href="user_man.php">管理</a> </li>
                <li class="<?php echo $li32;?>"> <a href="user_add.php">添加</a> </li>
              </ul>
            </li>
			<li class="nav-item nav-item-has-subnav <?php echo $li4;?>">
              <a href="javascript:void(0)"><i class="mdi mdi-comment-outline"></i> 留言</a>
              <ul class="nav nav-subnav">
                <li class="<?php echo $li41;?>"> <a href="msg_man.php">管理</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav <?php echo $li5;?>">
              <a href="javascript:void(0)"><i class="mdi mdi-settings"></i> 系统</a>
              <ul class="nav nav-subnav">
                <li class="<?php echo $li51;?>"> <a href="system.php">设置</a> </li>
              </ul>
            </li>
            <li class="nav-item nav-item-has-subnav">
              <a href="javascript:void(0)"><i class="mdi mdi-diamond"></i> 关于</a>
              <ul class="nav nav-subnav">
                <li> <a href="../about.php">我们</a> </li>
              </ul>
            </li>
          </ul>
        </nav>       
        <div class="sidebar-footer">
          <p class="copyright">Copyright &copy; 2020. <a target="_blank" href="http://daenx.cn">Daen</a> All rights reserved.</p>
        </div>
      </div>     
    </aside>
    <!--End 左侧导航-->
    
    <!--头部信息-->
    <header class="lyear-layout-header">     
      <nav class="navbar navbar-default">
        <div class="topbar">         
          <div class="topbar-left">
            <div class="lyear-aside-toggler">
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
              <span class="lyear-toggler-bar"></span>
            </div>
            <span class="navbar-page-title"> <?php echo $liname;?> </span>
          </div>          
          <ul class="topbar-right">
            <li class="dropdown dropdown-profile">
              <a href="javascript:void(0)" data-toggle="dropdown">
                <img class="img-avatar img-avatar-48 m-r-10" src="http://q.qlogo.cn/headimg_dl?bs=qq&dst_uin=<?php echo $qq;?>&src_uin=qq.zy7.com&fid=blog&spec=100" alt="Daen" />
                <span><?php echo $user;?><span class="caret"></span></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li> <a href="./"><i class="mdi mdi-account"></i> 后台首页</a> </li>
                <li> <a href="editpass.php"><i class="mdi mdi-lock-outline"></i> 修改密码</a> </li>
                <li class="divider"></li>
                <li> <a href="javascript:logout()"><i class="mdi mdi-logout-variant"></i> 退出登录</a> </li>
              </ul>
            </li>
            <!--切换主题配色-->
		    <li class="dropdown dropdown-skin">
			  <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
			  <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                <li class="drop-title"><p>主题</p></li>
                <li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="site_theme" value="default" id="site_theme_1" checked>
                    <label for="site_theme_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="site_theme" value="dark" id="site_theme_2">
                    <label for="site_theme_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="site_theme" value="translucent" id="site_theme_3">
                    <label for="site_theme_3"></label>
                  </span>
                </li>
			    <li class="drop-title"><p>LOGO</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                    <label for="logo_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                    <label for="logo_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                    <label for="logo_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                    <label for="logo_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                    <label for="logo_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                    <label for="logo_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                    <label for="logo_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                    <label for="logo_bg_8"></label>
                  </span>
				</li>
				<li class="drop-title"><p>头部</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                    <label for="header_bg_1"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                    <label for="header_bg_2"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                    <label for="header_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                    <label for="header_bg_4"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                    <label for="header_bg_5"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                    <label for="header_bg_6"></label>                      
                  </span>                                                    
                  <span>                                                     
                    <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                    <label for="header_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                    <label for="header_bg_8"></label>
                  </span>
				</li>
				<li class="drop-title"><p>侧边栏</p></li>
				<li class="drop-skin-li clearfix">
                  <span class="inverse">
                    <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                    <label for="sidebar_bg_1"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                    <label for="sidebar_bg_2"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                    <label for="sidebar_bg_3"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                    <label for="sidebar_bg_4"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                    <label for="sidebar_bg_5"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                    <label for="sidebar_bg_6"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                    <label for="sidebar_bg_7"></label>
                  </span>
                  <span>
                    <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                    <label for="sidebar_bg_8"></label>
                  </span>
				</li>
			  </ul>
			</li>
            <!--切换主题配色-->
          </ul>         
        </div>
      </nav>     
	<script type="text/javascript" src="../assets/js/Theme.js"></script>	  
    </header>
    <!--End 头部信息-->