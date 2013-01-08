<?php 


class LoginAction extends Action{
	function index(){
		
		//配置页面显示内容
		$admin=md5("admin");
		$this->assign('admin',$admin);
		$this->assign('title','后台管理系统');
		$this->display();
	}
	
	//用户登录页面
	function Login(){
		 header("Content-Type:text/html; charset=utf-8");
		 
		//首先检查验证码是否正确(验证码存在Session中)
		if(	$_SESSION['verify']	!=md5($_POST['verify'])	){
			$this->error('验证码错误');
		}
		
		$user=M('User');//参数的User必须首字母大写，否则自动验证功能失效！
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		if(!$this->checklen($username)){
			$this->error('用户名长度小于10个字符');
		}
		

		
		//查找输入的用户名是否存在
		if($user->where("user ='$username' AND pass = '$password'")->find()){
			
			session(login_username,$username);
			$url=U('/Index/index/username/'.$username);			
			redirect($url,0, '跳转中...');
		}else{
			$this->error('用户名或密码错误');
		}
		
	}
	
	function verify(){
		
	}
	
	function checklen($data){
			if(strlen($data)>10){
			return false;
		}
		return true;
	}
}



?>