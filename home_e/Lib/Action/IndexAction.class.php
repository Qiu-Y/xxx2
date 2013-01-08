 <?php
require("Public/phpmailer/class.phpmailer.php");
class IndexAction extends Action {
   
	public function index(){
		header("Content-Type:text/html; charset=utf-8");
		//目录
		$news=M('catalog');
		$news_list=$news->field(array('id','f_cata'))->order('id asc')->where('f_id=0')->select();
		//链接
		$link=M('link');
		$link_list=$link->field(array('id','addr','info'))->order('id desc')->select();
		//通知
		$tongzhi=M('tongzhi');
		$tongzhi_list=$tongzhi->field(array('id','title','content','name','dt'))->order('id desc')->select();
		
		$this->assign('news_list',$news_list);
		$this->assign('link_list',$link_list);	
		$this->assign('title','信号与系统');
		$this->assign('tongzhi_list',$tongzhi_list);
		
		if(session('?username')){//不存在
			$this->display();	
		}
		else//存在
		{
			if(trim(session('username'))=='')
			{
				$this->display();	
				
			}
			else 
			{
				$this->assign('username',session('username'));
				echo "<script>alert('".session('username')."')</script>";
				redirect(U('/Show/index'),0, '进入主页');
			}
			//$this->display();
		}
	}
	
	
	
	function index_regist(){
		
		//目录
		$news=M('catalog');
		$news_list=$news->field(array('id','f_cata'))->where('f_id=0')->select();
		//链接
		$link=M('link');
		$link_list=$link->field(array('id','addr','info'))->select();
		
		
		$this->assign('news_list',$news_list);
		$this->assign('link_list',$link_list);
		$this->display();
	}
	
	function index_pwd(){
	
		//目录
		$news=M('catalog');
		$news_list=$news->field(array('id','f_cata'))->where('f_id=0')->select();
		//链接
		$link=M('link');
		$link_list=$link->field(array('id','addr','info'))->select();
		
		
		$this->assign('news_list',$news_list);
		$this->assign('link_list',$link_list);
		$this->display();
	}
	
	//登陆
	function login(){
	
		
		session_start();
		header("Content-Type:text/html; charset=utf-8");
		$username=$_POST["username"];
		$pwd=md5($_POST["password"]);
		if($username==""||$pwd=="")
		{
			$this->error("不能为空！");	
		}
		else{
			$lo=M('Login');
			if($lolist=$lo->where("username='$username' and pwd='$pwd'")->find())
			{
				$lolist['logintimes']+=1;
				$lo->where("username='$username'")->save($lolist);
				session(username,$username);
				session(shenfen,'student');
				$this->success("登陆成功",U("/Show/index"));	
			}
			else
			{
				$lo1=M('teacher');
				if($lolist=$lo1->where("username='$username' and pwd='".$_POST["password"]."'")->find())
				{
					$lolist['logins']+=1;
					$lo->where("username='$username'")->save($lolist);
					session(username,$username);
					session(shenfen,'teacher');			

					$this->success("登陆成功",U("/Show/index"));		
				}
				else{
					$this->error("用户名或密码填写错误，请重新填写！");	
				}
			}
		
		}
			
	}
	
	//找回密码
	
	function pwd(){
		$num=$_POST["num"];
		$mail=$_POST["mail"];
		$mode='/([\w\.\_]{2,6})@(\w{1,}).([a-z]{2,10})/';
		
		if($num==""||$mail=="")
		{
			$this->error("请填写全部，谢谢合作！");	
		}
		else if(!preg_match($mode, $mail))
		{
			$this->error("邮箱规格不正确，请重新填写！");	
		}
		else
		{
			$lo=M('Login');
			if($lolist=$lo->field(array('username','pwd'))->where("num='$num' and mails='$mail'")->find())
			{
				
				$content=$lolist['username']."你好，你的密码是".$lolist['pwd'];
				if(SendMail($mail,"欢迎注册",$content))
				{
					$this->success("密码已发送到你邮箱，请查收");	
					$this->index();
				}
				else
				{
					$this->error("邮件错误！");		
				}
			}
			else
			{
				
				$this->error("不存在，请重新填写！");	
			}
		}
		
	}
	
	
	
	//注册
	function reg(){		
		
		$name=$_POST["username"];
		$num=$_POST["num"];
		$class=$_POST["class"];
		$sex=$_POST["sex"];
		$password=$_POST["password"];
		$re_password=$_POST["re_password"];
		$qq=$_POST["qq"];
		$mail=$_POST["mail"];
		$phone=$_POST["phone"];
		$addr=$_POST["addr"];
		
		$mode='/([\w\.\_]{2,6})@(\w{1,}).([a-z]{2,10})/';
		if($name==""||$num==""||$password==""||$re_password==""||$mail==""||$phone=="")
		{
			$this->error("为了方便联系，带*为必填，谢谢合作！");	
		}
		else if($password!=$re_password)
		{
			$this->error("两次密码填写不一致！");	
		}
		else if(!preg_match($mode, $mail))
		{
			$this->error("邮箱规格不正确，请重新填写！");	
		}
		else if($phone!=""&&(!preg_match("/13[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/", $phone)))
		{
				echo "<script>alert('aa')</script>";
				$this->error("手机号码格式不正确，请重新填写！");	
		}
		else
		{
			$lo=M('Login');
			if($lo->where("username='$username'")->find())
			{
				$this->error("该用户已存在，请重新填写！");	
			}
			else if($lo->where("mails='$mail'")->find())
			{
				$this->error("该邮箱已存在，请重新填写！");	
			}
			else
			{
				$login=D('Login');
				if($login->create())
				{
					
					$login->name=$name;
					$login->username=$num;
					$login->num=$num;
					$login->clas=$class;
					$login->sex=$sex;
					$login->pwd=md5($password);
					$login->qq=$qq;
					$login->mails=$mail;
					$login->phone=$phone;
					$login->addr=$addr;
					$content=$username."你好，恭喜你，在本网站注册成功！";
					if(SendMail($mail,"欢迎注册",$content))
					{
						if($login->add()){
							session(username,$username);
							$this->assign('username',session('username'));
							$this->success('注册成功,进入页面',U('/Show/index'));
							
						}
						else
						{
							$this->error('注册失败，返回上级页面');
						}	
					}
					else
					{
							$this->error('邮箱不存在，返回上级页面');
					}
				}
				else{
					$this->error('数据库连接失败，返回上级页面');
					}
			}
					
		}
	
	}
	

}