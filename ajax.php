<?php
include './data/common.php';
$do = $_GET["do"];
$requstArr = array("login","reg","logout");//定义的指令数组
if(isRight($do,$requstArr)){
	if($do!=$requstArr[2]){//退出登录不需要验证
		if(isVaptcha($system['sign_vid'],$system['sign_key'],$_POST['token'],real_ip())!=true){
				$data = array(
				"status"=>0,
				"msg"=>'token error',
				"pg_id"=>$res['id'],
				"pg_name"=>$res['name']
				);
				echo json_encode($data);
				return;
		}
	}
	
	$api = new API($password_hash,$DB,$system);
	switch($do){
		case $requstArr[0]:
			echo $api->login($_POST['user'],$_POST['pass']);
			break;
		case $requstArr[1]:
			echo $api->reg($_POST['user'],$_POST['pass'],$_POST['qq']);
			break;
		case $requstArr[2]:
			echo $api->logout();
			break;
		default://此处的default无意义，因为我们在上方已经对指令正确性做了处理，错误的请求指令将不会进入此
			return;
	}
	return;
}
class API{
	public $password_hash;
	public $DB;
	public $system;
	public function __construct($password_hash,$DB,$system){//初始化方法
		$this->password_hash = $password_hash;
		$this->DB = $DB;
		$this->system = $system;
	}
	public function login($user,$pass){//登录
		$rs=$this->DB->query("select * from ".constant("TABLE")."user where user = '".$user."' or qq = '".$user."' and pass = '".$pass."'");
		if($res = $this->DB->fetch($rs)){
			if($pass == $res['pass']){
				if($res['status']==0){
					return json_encode(array('code'=>203,'msg'=>'此账号已被禁止登录'));
				}else{
					$session=md5($res['user'].$res['pass'].$this->password_hash);
					$token=authcode("{$res['uid']}\t{$res['user']}\t{$res['qq']}\t{$session}", 'ENCODE', SYS_KEY);
					setcookie("user_token", $token, time() + 604800);
					$rs=$this->DB->query("UPDATE ".constant("TABLE")."user SET updtime='".time()."' WHERE uid='".$res['uid']."'");
					return json_encode(array('code'=>200,'msg'=>'登录成功'));
				} 
			}else{
				return json_encode(array('code'=>202,'msg'=>'密码错误'));        
			}
		}else{
			return json_encode(array('code'=>201,'msg'=>'账号或者密码错误'));
		}
	}	
	public function reg($user,$pass,$qq){//注册
		if($this->system['user_status']==0){
			return json_encode(array('code'=>204,'msg'=>'暂时未开放注册，敬请期待！'));  
		}else{
			$rs=$this->DB->query("select * from ".constant("TABLE")."user where user = '{$user}'");
			$num = $this->DB->affected($rs);
			if($num){
				return json_encode(array('code'=>205,'msg'=>'账号已存在'));  
			}else{
				$data = array(
				"user"=>$user,
				"pass"=>$pass,
				"status"=>1,
				"qq"=>$qq,
				"addtime"=>time(),
				"updtime"=>time()
				);
				$rs=$this->DB->insert_array(constant("TABLE")."user",$data);
				$num = $this->DB->affected($rs);
				if($num){
					return json_encode(array('code'=>200,'msg'=>'注册成功'));
				}else{
					return json_encode(array('code'=>206,'msg'=>'注册失败'));
				}		
			}
		}
	}
	public function logout(){//退出登录
		setcookie("user_token","", time() - 604800);
		return json_encode(array('code'=>200,'msg'=>'退出成功'));
	}
}	

?>