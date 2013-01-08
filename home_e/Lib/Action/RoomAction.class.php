<?php
require("Public/phpmailer/class.phpmailer.php");
class RoomAction extends Action {
   
	public function index(){
		header("Content-Type:text/html; charset=utf-8");
		$username=session('username');
		
		$login=M('login');
		//if($login_user=$login->where("username='".$username."'")->find())
//		{
//			$login_name=$login_user['name'];
//		}
//		else
//		{
//			$teacher=M('teacher');	
//			$teacher_list=$teacher->where("username='".$username."'")->select();
//			$login_name=$teacher_list['name'];
//		}

		$this->assign('login_name',$username);
		
		$this->display();

	}
	
	function basic_info(){
		header("Content-Type:text/html; charset=utf-8");
		$username=session('username');
		$login=M('login');
		$basic_info=$login->where("username='".$username."'")->find();
		$this->assign('basic_info',$basic_info);
		$this->display();
	
	}
	
	function room(){
		if($id=trim($_GET["username"]))	
		{
			redirect(U('/Room/index/'));
				
		}
	}
	function update(){
		//导入图片上传类  
            import("ORG.Net.UploadFile");  
            //实例化上传类  
            $upload = new UploadFile();  
            $upload->maxSize = 3145728;  
            //设置文件上传类型  
            $upload->allowExts = array('jpg','png','gif');  
            //设置文件上传位置  
            $upload->savePath = "./Public/Uploads/";//这里说明一下，由于ThinkPHP是有入口文件的，所以这里的./Public是指网站根目录下的Public文件夹  
            //设置文件上传名(按照时间)  
            //$upload->saveRule = "time";  
            if (!$upload->upload()){  
				
                $this->error($upload->getErrorMsg());  
            }else{  
                //上传成功，获取上传信息
				echo "<script>alert('".$info[0]["savePath"]."')</script>";
                $info = $upload->getUploadFileInfo();  
            }  
			
  
           // 保存表单数据，包括上传的图片  
         //   $login = M("login");  
//            $login->create();  
//            $savename = $info[0]['savename'];  
//            $imgurl = "http://localhost/Public/Uploads/".$savename;//这里是设置文件的url注意使用.不是+  
//            $data['gamename'] = $_POST['gamename'];  
//            $data['gameimg'] = $imgurl;  
//            $data['gameinfo'] = $_POST['gameinfo'];  
//            $data['gamelink'] = $_POST['gamelink'];  
//            $data['publishtime'] = date("Y-m-d H:i:s");  
//            $res = $game->add($data);//写入数据库   
//            if ($res){  
//                $this->redirect("addGame","",2,"添加成功！两秒后跳回");  
//            }else{  
//                $this->redirect("addGame","",2,"失败！两秒后跳回");  
//            }  
		
	}
	
	//短消息
	function short_msg(){
		
		$name=session('name');
		$msg=M('msg');
		$count=$msg->where("to_name='".$name."'")->count();
		$msg_list=$msg->where("to_name='".$name."'")->select();
		
		
		//分页显示文章列表，每页8篇文章
		import('ORG.Util.Page');
		$page=new Page($count,8);//后台管理页面默认一页显示8条文章记录

		$page->setConfig('prev', "&laquo; Previous");//上一页
		$page->setConfig('next', 'Next &raquo;');//下一页
		$page->setConfig('first', '&laquo; First');//第一页
		$page->setConfig('last', 'Last &raquo;');//最后一页	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
		//设置分页回调方法
		$show=$page->show();
		
		$msg_list=$msg->where("to_name='".$name."'")->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		$this->assign('class_list',$class_list);
		$this->assign('page_method',$show);
		
		$this->assign('msg_list',$msg_list);
		$this->display();
		
		
	}
	
	//密码修改 start
	function change_pwd(){
		$username=session('username');
		$this->assign('username',$username);
		$this->display();
	}
	
	function change_second(){
		$id=$_GET['id'];

		$old_pwd=$_POST['old_pwd'];
		$pwd=$_POST['pwd'];
		$re_pwd=$_POST['re_pwd'];
		if($pwd==""||$re_pwd==""||$old_pwd=="")
		{
			$this->error('不能为空！');
		}
		
		else
		{
			$login=M('login');
			$login_list=$login->where("username='".$id."'")->find();
			$rel_pwd=$login_list['pwd'];
			if($old_pwd!=$rel_pwd)
			{
				$this->error('旧密码输入错误！');
			}
			else if($pwd!=$re_pwd)
			{
				$this->error('两次输入密码不同！');
			}
			else
			{
				$data=array('pwd'=>$pwd);
				if($login->where('username='.$id)->setField($data))
				{
					$this->success('密码修改成功');
				}
			}

		}
		
	}
	
	
	//密码修改 end
	
	
	
	function msg_list(){
		$id=$_GET['id'];
		$msg=M('msg');
		$msg_list=$msg->where("id='".$id."'")->select();
		$this->assign('msg_list',$msg_list);
		
		$this->display();
	}
	
	function repeat(){		
		
		$id=$_GET['id'];
		$msg=M('msg');
		$data=array('repeat'=>$_POST['content'],'statue'=>'1');
		if($msg->where('id='.$id)->setField($data))
		{
			$this->success('回复成功',U('Room/short_msg'));		
		}
		
	}
	
	function work_list(){
		header("Content-Type:text/html; charset=utf-8");
		$name=session('username');
		$login=M('login');
		if($login_list=$login->where('username='.$name)->find()){
			$classname=trim($login_list['clas']);
			$class=M('class');
			if($class_list=$class->where("classname='".$classname."'")->find())
			{
				$teacher=$class_list['teacher'];
				$work=M('work');
				$count=$work->where("name='".$teacher."'")->count();
				//分页显示文章列表，每页8篇文章
				import('ORG.Util.Page');
				$page=new Page($count,8);//后台管理页面默认一页显示8条文章记录
		
				$page->setConfig('prev', "&laquo; Previous");//上一页
				$page->setConfig('next', 'Next &raquo;');//下一页
				$page->setConfig('first', '&laquo; First');//第一页
				$page->setConfig('last', 'Last &raquo;');//最后一页	
				$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
				//设置分页回调方法
				$show=$page->show();
				
				$work_list=$work->where("name='".$teacher."'")->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
				
				$workroute=M('workroute');
				$workroute_list=$workroute->where("username=".$name)->select();
			
				
				$this->assign('page_method',$show);
				$this->assign('work_list',$work_list);
				$this->assign('workroute_list',$workroute_list);
				
				
			}
			else
			{
				
			}
		}
		
		
		
		
		
		
		
		$this->display();
	}
	
	function w_list(){
		
	}
	
	
	function handout(){
		$id=$_GET['id'];
		$work=M('work');
		if($work_list=$work->where("id=".$id)->find())
		{
			$this->assign('worklist',$work_list);
			$this->display();
		}
		else{
			$this->error("参数错误");
		}
		
		
		
		
	}
	
	
	function add_hand(){
		$id=$_POST['id'];
		$username=session('username');
		
		
		 import("ORG.Net.UploadFile");  
		//实例化上传类  
		$upload = new UploadFile();  
		$upload->maxSize = 3145728;  
		//设置文件上传类型  
		$upload->allowExts = array('rar','doc');  
		//设置文件上传位置  
		$upload->savePath = "./Public/Work/".$id."/";//这里说明一下，由于ThinkPHP是有入口文件的，所以这里的./Public是指网站根目录下的Public文件夹  
		//设置文件上传名(按照时间)  
			

		
		if (!$upload->upload())
		{  
			$this->error($upload->getErrorMsg());  
		}
		else{ 
			$info = $upload->getUploadFileInfo();
			
			
			$workname=$info[0]["savename"];  
			$route="./Public/Work/".$id."/".$workname;  
			
			
			echo "<script>alert('$id')</script>";
			echo "<script>alert('$username')</script>";
			echo "<script>alert('$route')</script>";
			echo "<script>alert('$workname')</script>";
			 
			
			$workroute=M('workroute');
			if($workroute->create())
			{
				echo "<script>alert('cc')</script>";
				$data['home_id']=$id;
				$data['username']=$username;
				$data['route']=$route;
				$data['workname']=$workname;
				$data['hand_time'] = date("Y-m-d H:i:s");  
				$res = $workroute->add($data);//写入数据库   
				if ($res){  
					echo "<script>alert('aa')</script>";
					redirect(U('/Room/work_list'));  
				}else{  
					echo "<script>alert('bb')</script>";
					$this->error("参数错误");  
				}  
				
				
				
			}
			
		}  
			
			
			
		
		
	}
	
	

}