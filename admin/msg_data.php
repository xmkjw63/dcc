<?php
$li2 = 'open active';
$li23 = 'active';
$liname = '应用数据';
include 'head.php';
include 'list.php';
if($_GET['pid'] == '' || $_GET['addtime'] == ''){
	echo "<script>Daen_confirm('error','啊哦','请通过应用管理-操作-数据进入<br>即将为您跳转~',true,'plugin_man.php');</script>";
	return;
}
$pluginTotal = getPlugin($DB,$_GET['pid']);

$rs=$DB->query("SELECT * FROM ".constant("TABLE")."plog WHERE pid='".$_GET['pid']."'");
$count = 0;$success_count = 0;$fail_count = 0;
while($res = $DB->fetch($rs)){
	$count = $count + 1;
	if($res['status']==1){
		$success_count = $success_count + 1;
	}
	if($res['status']==0){
		$fail_count = $fail_count + 1;
	}
}
$age =ceil((time() - $_GET['addtime'])/60/60/24);
?>

      
     <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">正确请求</p>
                  <p class="h3 text-white m-b-0"><?php echo $success_count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-currency-cny fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">非法请求</p>
                  <p class="h3 text-white m-b-0"><?php echo $fail_count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-account fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-success">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">使用总数</p>
                  <p class="h3 text-white m-b-0"><?php echo $count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-purple">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">应用年龄</p>
                  <p class="h3 text-white m-b-0"><?php echo $age?>天</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-comment-outline fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          
          <div class="col-lg-12"> 
            <div class="card">
              <div class="card-header">
                <h4>最近两周内API调用</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-lines"></canvas>
              </div>
            </div>
          </div>
           
        </div>
        

        
      </div>
      
    </main>
    <!--End 页面主要内容-->

<!--图表插件-->
<script type="text/javascript" src="../assets/js/Chart.js"></script>
<script type="text/javascript">
function fun_date(aa){
        var date1 = new Date(),
        time1=date1.getFullYear()+"-"+(date1.getMonth()+1)+"-"+date1.getDate();
        var date2 = new Date(date1);
        date2.setDate(date1.getDate()+aa);
        var time2 = date2.getFullYear()+"-"+(date2.getMonth()+1)+"-"+date2.getDate();
        return time2;
}

$(document).ready(function(e) {
    var $dashChartLinesCnt = jQuery( '.js-chartjs-lines' )[0].getContext( '2d' );

    var $dashChartLinesData = {
		labels: [fun_date(-13), fun_date(-12), fun_date(-11), fun_date(-10), fun_date(-9), fun_date(-8), fun_date(-7), fun_date(-6), fun_date(-5), fun_date(-4), fun_date(-3), fun_date(-2), fun_date(-1), fun_date(0)],
		datasets: [
			{
				label: '正确请求',
				data: [<?php echo $pluginTotal[0][0] ?>,<?php echo $pluginTotal[1][0] ?>,<?php echo $pluginTotal[2][0] ?>,<?php echo $pluginTotal[3][0] ?>,<?php echo $pluginTotal[4][0] ?>,<?php echo $pluginTotal[5][0] ?>,<?php echo $pluginTotal[6][0] ?>,<?php echo $pluginTotal[7][0] ?>,<?php echo $pluginTotal[8][0] ?>,<?php echo $pluginTotal[9][0] ?>,<?php echo $pluginTotal[10][0] ?>,<?php echo $pluginTotal[11][0] ?>,<?php echo $pluginTotal[12][0] ?>,<?php echo $pluginTotal[13][0] ?>],
				borderColor: '#358ed7',
				backgroundColor: 'rgba(53, 142, 215, 0.175)',
                borderWidth: 1,
                fill: false,
                lineTension: 0.5
			},
			{
				label: '非法请求',
				data: [<?php echo $pluginTotal[0][1] ?>,<?php echo $pluginTotal[1][1] ?>,<?php echo $pluginTotal[2][1] ?>,<?php echo $pluginTotal[3][1] ?>,<?php echo $pluginTotal[4][1] ?>,<?php echo $pluginTotal[5][1] ?>,<?php echo $pluginTotal[6][1] ?>,<?php echo $pluginTotal[7][1] ?>,<?php echo $pluginTotal[8][1] ?>,<?php echo $pluginTotal[9][1] ?>,<?php echo $pluginTotal[10][1] ?>,<?php echo $pluginTotal[11][1] ?>,<?php echo $pluginTotal[12][1] ?>,<?php echo $pluginTotal[13][1] ?>],
				borderColor: '#ff0000',
				backgroundColor: 'rgba(255, 0, 0, 0.175)',
                borderWidth: 1,
                fill: false,
                lineTension: 0.5
			}
		]
	};
    

    
    var myLineChart = new Chart($dashChartLinesCnt, {
        type: 'line',
        data: $dashChartLinesData,
    });
});
</script>


<?php
include 'footer.php';
?>