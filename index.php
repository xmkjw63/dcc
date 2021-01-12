<?php
$index_active = 'active';
$plugin_name = '首页';
include 'head.php';
include 'list.php';
if($system['index_status']==1){
		echo "<script>Daen_confirm('success','公告','".$info['index_info']."');</script>";
}
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        <br><br><br><br><br><br><br><br><br><br><br>
        <div class="divider text-uppercase">点击侧边栏开始吧</div>  
      </div>    
    </main>
    <!--End 页面主要内容-->


<?php
include 'footer.php';
?>