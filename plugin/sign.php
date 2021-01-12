<style>
  .vaptcha-init-main {
    display: table;
    width: 100%;
    height: 100%;
    background-color: #eeeeee;
  }
​
  .vaptcha-init-loading {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
  }
​
  .vaptcha-init-loading > a {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: none;
  }
​
  .vaptcha-init-loading > a img {
    vertical-align: middle;
  }
​
  .vaptcha-init-loading .vaptcha-text {
    font-family: sans-serif;
    font-size: 12px;
    color: #cccccc;
    vertical-align: middle;
  }
</style>
<!-- 点击式按钮建议高度介于36px与46px  -->
<div id="vaptchaContainer" style="width: 300px;height: 36px;">
  <!--vaptcha-container是用来引入VAPTCHA的容器，下面代码为预加载动画，仅供参考-->
  <div class="vaptcha-init-main">
    <div class="vaptcha-init-loading">
      <a href="/" target="_blank">
        <img src="https://r.vaptcha.net/public/img/vaptcha-loading.gif" />
      </a>
      <span class="vaptcha-text">Vaptcha启动中...</span>
    </div>
  </div>
</div>
<script src="https://v.vaptcha.com/v3.js"></script>
<script>
var token='';
vaptcha({
  vid: '<?=$system["sign_vid"]?>', // 验证单元id
  type: "click", // 显示类型 点击式
  scene: 0, // 场景值 默认0
  container: "#vaptchaContainer",
}).then(function (vaptchaObj) {
  obj = vaptchaObj;
  vaptchaObj.render();
  vaptchaObj.listen("pass", function () {
		token = vaptchaObj.getToken();
		Daen_notify('success','验证通过');
  });
  //关闭验证弹窗时触发
  vaptchaObj.listen("close", function () {
		Daen_notify('warning','您取消了人机验证');
  });
});
</script>
<div class="form-group">

</div>	