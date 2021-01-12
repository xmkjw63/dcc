<?php
$li1 = 'active';
$liname = '首页';
include 'head.php';
include 'list.php';
$userTotal = getUserTotal($DB);
$pluginTotal = getPluginTotal($DB);

$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."plugin WHERE 1");
$res = $DB->fetch($rs);
$plugin_count = $res['count(*)'];
$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."user WHERE 1");
$res = $DB->fetch($rs);
$user_count = $res['count(*)'];
$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."plog WHERE 1");
$res = $DB->fetch($rs);
$log_count = $res['count(*)'];
$rs=$DB->query("SELECT count(*) FROM ".constant("TABLE")."msg WHERE 1");
$res = $DB->fetch($rs);
$msg_count = $res['count(*)'];
?>
    
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-primary">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">应用总数</p>
                  <p class="h3 text-white m-b-0"><?php echo $plugin_count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-cube-outline fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">用户总数</p>
                  <p class="h3 text-white m-b-0"><?php echo $user_count?></p>
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
                  <p class="h3 text-white m-b-0"><?php echo $log_count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="card bg-purple">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">留言总数</p>
                  <p class="h3 text-white m-b-0"><?php echo $msg_count?></p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-comment-outline fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          
          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>最近一周内新增用户</h4>
              </div>
              <div class="card-body">
                <canvas class="js-chartjs-bars"></canvas>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6"> 
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
    var $dashChartBarsCnt  = jQuery( '.js-chartjs-bars' )[0].getContext( '2d' ),
        $dashChartLinesCnt = jQuery( '.js-chartjs-lines' )[0].getContext( '2d' );
    
    var $dashChartBarsData = {
		labels: [fun_date(-6), fun_date(-5), fun_date(-4), fun_date(-3), fun_date(-2), fun_date(-1), fun_date(0)],
		datasets: [
			{
				label: '新增用户',
                borderWidth: 1,
                borderColor: 'rgba(0,0,0,0)',
				backgroundColor: 'rgba(51,202,185,0.5)',
                hoverBackgroundColor: "rgba(51,202,185,0.7)",
                hoverBorderColor: "rgba(0,0,0,0)",
				data: [<?php echo $userTotal[0] ?>, <?php echo $userTotal[1] ?>,<?php echo $userTotal[2] ?>, <?php echo $userTotal[3] ?>, <?php echo $userTotal[4] ?>, <?php echo $userTotal[5] ?>, <?php echo $userTotal[6] ?>]
			}
		]
	};
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
    
    new Chart($dashChartBarsCnt, {
        type: 'bar',
        data: $dashChartBarsData
    });
    
    var myLineChart = new Chart($dashChartLinesCnt, {
        type: 'line',
        data: $dashChartLinesData,
    });
});
</script>
<?php
include 'footer.php';
?>