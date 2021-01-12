</div>
</div>
<script src="../data/function.js"></script>
<?php
if($system['webdata'] != ""){echo $system['webdata'];}
?>
<script>
	$(document).ready(function(){
		$('#push').click(function(){
			Daen_confirm('success','欢迎投稿','请联系管理员投稿<?php echo $system["admin_name"]?><br>QQ：<?php echo $system["admin_qq"]?>');
		});
	});
	</script>
</body>
</html>