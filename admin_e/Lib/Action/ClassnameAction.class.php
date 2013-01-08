<?php
/**
     * @类		IndexAction
     * @功能	后台首页控制器
*/
class ClassnameAction extends Action {	
	/**
     * @函数	index
     * @功能	显示后台管理主页面（包含登录判断）
     */
    public function classname(){ 
		header("Content-Type:text/html; charset=utf-8");
		
		$clas=M('class');
		$class_name=$clas->field(array('classname'))->select();
		
		$student=M('login');				
		if($_GET['clas'])
		{
			$count=$student->where("clas='".$_GET['clas']."'")->count();
			$student_list=$student->where("clas='".$_GET['clas']."'")->field(array('id','clas','username','phone','num'))->select();	
		}
		else
		{
			$count=$student->where("clas='通信1101'")->count();
			$student_list=$student->where("clas='通信1101'")->field(array('id','clas','username','phone','num'))->select();	
		}
		
		
		
		//分页显示文章列表，每页8篇文章
		import('ORG.Util.Page');
		$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录

		$page->setConfig('prev', "&laquo; Previous");//上一页
		$page->setConfig('next', 'Next &raquo;');//下一页
		$page->setConfig('first', '&laquo; First');//第一页
		$page->setConfig('last', 'Last &raquo;');//最后一页	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
		//设置分页回调方法
		$show=$page->show();
		
		
		
		
		$this->assign('news_count',$count);
		$this->assign('title','后台管理系统');
		$this->assign('class_name',$class_name);
		$this->assign('student_list',$student_list);
		$this->assign('page_method',$show);				
		$this->display();
			
		
    }
	//老师展示
	
	
	function teachername(){
		header("Content-Type:text/html; charset=utf-8");
		
		$teacher=M('teacher');					
		$count=$teacher->count();	
		//分页显示文章列表，每页8篇文章
		import('ORG.Util.Page');
		$page=new Page($count,10);//后台管理页面默认一页显示8条文章记录

		$page->setConfig('prev', "&laquo; Previous");//上一页
		$page->setConfig('next', 'Next &raquo;');//下一页
		$page->setConfig('first', '&laquo; First');//第一页
		$page->setConfig('last', 'Last &raquo;');//最后一页	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
		
		
		$teacher_list=$teacher->field(array('id','username','name','phone','e_mail'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		
		//设置分页回调方法
		$show=$page->show();
		
		$this->assign('news_count',$count);
		$this->assign('title','后台管理系统');
		$this->assign('teacher_list',$teacher_list);
		$this->assign('page_method',$show);				
		$this->display();
	}
	
	
	//添加老师页面
	function add_teacher(){
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','通知');
		$teacher=M('teacher');

		if($id=$_GET['id']){
			$teacher_item=$teacher->where("id='".$id."'")->find();
			$this->assign('teacher_item',$teacher_item);	
			
			$this->assign('btn_ok_text','更新');
			$this->assign('btn_ok_act','update_t');
		}
		else{
			$this->assign('btn_ok_act','add_t');
			$this->assign('btn_ok_text','添加');
			
		}
		$this->display();
	}
	
	//添加老师操作
	function add_t(){
		header("Content-Type:text/html; charset=utf-8");
		$username = $_POST['username'];
		$name   = $_POST['name'];
		if($username==""||$name=="")
		{
			$this->error('不能为空！');	
		}
		else
		{
			$teacher=M('teacher');	
			if($teacher->where("username='".$username."' or name='".$name."'")->find())	
			{
				$this->error('该班级已存在，请重新输入，返回上级页面');
			}
			else
			{
				if($teacher->create()){
					$teacher->username =$username;
					$teacher->name	=$name;
					$teacher->pwd	=$username;
					if($teacher->add()){
						$this->success('老师添加成功',U('Classname/add_teacher'));
					}
					else{
						$this->error('老师添加失败，返回上级页面');
					}
					
				}else{
					$this->error($teacher->getError());
				}	
			}
		}
	}
	
	function update_t(){
		
		$teacher=M('teacher');
		$data = array('username'=>$_POST['username'],'name'=>$_POST['name'],'pwd'=>$_POST['username']);		
		$id=$_POST['id'];

		if($teacher->where('id='.$id)->setField($data))
		{
			$this->success('修改成功',U('Classname/class_lis'));	
		} // 根据条件保存修改的数据
		else
		{
			$this->error($teacher->getLastSql());
		}
		
		
	}
	function class_lis(){
		//实例化文章模型
			$class=M('class');	
			$count=$class->count();
			
		
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
	
			$class_list=$class->field(array('id','classname','teacher','amount'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
			
			$this->assign('count',$count);
			$this->assign('title','后台管理系统');
			$this->assign('class_list',$class_list);
			$this->assign('page_method',$show);
						
			$this->display();
		
	}
	
	
	function search()
	{
		$sel=$_POST['select'];
		if($sel){
			redirect(U('/Classname/classname/clas/'.$sel),0, '编辑文章');
		}
		else
		{
			$this->error('参数不存在！');
		}
		
	}
	
	function add_class(){
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','通知');
		$class=M('class');
		
		if($id=$_GET['id']){
			$class_item=$class->where("id='".$id."'")->find();
			$this->assign('class_item',$class_item);	
			
			$this->assign('btn_ok_text','更新');
			$this->assign('btn_ok_act','update');
		}
		else{
			$this->assign('btn_ok_act','add');
			$this->assign('btn_ok_text','添加');
			
		}
		$this->display();	
		
	}
	
	function add(){
		
		//header("Content-Type:text/html; charset=utf-8");
		$classname = $_POST['classname'];
		$teacher   = $_POST['teacher'];
		if($classname=="")
		{
			$this->error('班级不能为空');	
		}
		else
		{
			$Class=D('Class');	
			if($Class->where("classname='".$classname."'")->find())	
			{
				$this->error('该班级已存在，请重新输入，返回上级页面');
			}
			else
			{
				if($Class->create()){
					$Class->classname =$classname;
					$Class->teacher	=$teacher;
					$Class->amount	=$_POST['amount'];
					
					if($Class->add()){
						$this->success('班级添加成功',U('Classname/class_lis'));
					}else{
						$this->error('班级添加失败，返回上级页面');
					}
					
				}else{
					$this->error($Class->getError());
				}	
			}
		}
	}
	
	function update(){
		
		$Class=M('class');
		$data = array('classname'=>$_POST['classname'],'teacher'=>$_POST['teacher'],'amount'=>$_POST['amount']);		
		$id=$_POST['id'];

		if($Class->where('id='.$id)->setField($data))
		{
			$this->success('修改成功',U('Classname/class_lis'));	
		} // 根据条件保存修改的数据
		else
		{
			$this->error($Class->getLastSql());
		}
	}
	
	function delete_class(){
		$id=$_GET['id'];
		$class=M('class');
		if($class->delete($_GET['id'])){
			$this->success('班级已删除');
		}else{
			$this->error($login->getLastSql());
		}
	}
	
	
	function delete_ss(){
		$id=$_GET['id'];
		$login=M('login');
		if($login->delete($_GET['id'])){
			$this->success('该同学已删除！');
		}else{
			$this->error($login->getLastSql());
		}
	}
	
	
	
    /**
     其他链接
     */
	 
	function add_news(){
		redirect(U('/Article/index/'));
		
	}
	
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Login/index'),0, '重新登录');
    }
	
	
	function tzlis(){
		redirect(U('/Inform/tzlis/'));
		
	}
	
	function add_tz(){
		redirect(U('/Inform/add_tz/'));
	}
	
	//回到首页
	function in(){
		redirect(U('/Index/index'),0, '回到首页');
	}
	
	function lis(){
		redirect(U('/Article/lis'),0, '新闻修改');
	}
	
	function article(){
    	//跳转
    	redirect(U('/Article/index'),0, '新闻添加');
    } 
	function catalog(){
		redirect(U('/Index/catalog'),0, '目录');
	}
	
	function add_second(){
		redirect(U('/Index/add_second'),0, '班级管理');
	}
	
	function link(){
		redirect(U('/Index/link'),0, '友情链接');
	}
	
	function film_add(){
		redirect(U('/Film/film_add'),0, '视频添加');
	}
	
	function film_mag(){
		redirect(U('/Film/film_mag'),0, '视频添加');
	}
	
    
}

