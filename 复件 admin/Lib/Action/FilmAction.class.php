<?php

class FilmAction extends Action{
	
	private  $article_item;
	/**
     * @函数	index
     * @功能	显示添加文章主页面
     */
	 
	function select(){
		$selType = trim($_GET["name"]);
		$array="";
		$catalog=M('catalog');
		if($catalog_list=$catalog->where("f_cata='".$selType."'")->find())
		{
			$id=$catalog_list['id'];
			if($array=$catalog->where("f_id='".$id."' and isf=0")->select())
			{
				$this->ajaxReturn($array);
				$this->assgn('array',$array);
			}
			else{
				$this->ajaxReturn($array,'失败',0);
			}
			
		}
		else{
			echo urldecode(json_encode($selType));
		}
	}
	
	
	function film_add(){
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','管理页面');
		$catalog=M('catalog');
		$temp;
		if($id=(int)$_GET['id']){
			$temp=0;
			$film=M('film');
			$film_item=$film->where("id=$id")->find();
			
			$this->assign('film_item',$film_item);	
			$this->assign('btn_ok_text','完成修改');
			$this->assign('btn_ok_act','update');
		}
		else{
			$temp=1;
			$mulu=$catalog->where("isf=1")->field(array('id','f_cata','isf','f_id','p_id'))->select();
			$this->assign('btn_ok_act','add');
			$this->assign('btn_ok_text','添加视频');
		}
		$this->assign('temp',$temp);
		$this->assign('mulu',$mulu);
		$this->display();
	}
	
	/**
     * @函数	add
     * @功能	文章添加完成，写入数据库
     */
    function film_mag(){
		header("Content-Type:text/html; charset=utf-8");

		if(session('?login_username')){
			$this->assign('username',session('login_username'));
			$cata=M('catalog');
			$mulu=$cata->where("isf=1")->field(array('id','f_cata','isf','f_id','p_id'))->select();
				
			if($_GET['select']!=""){
				//实例化文章模型
				$film=M('film');
					
				$select=$_GET['select'];
				$second=$_GET['second'];
				
				
				$count=$film->where("f_cata='$second'")->count();
			
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
		
				$film_list=$film->where("f_cata='$second'")->field(array('id','title','f_cata','user','title','dt'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
				
				
				
			}
			else{
				//实例化文章模型
				$film=M('film');	
				$count=$film->count();
				
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
		
				$film_list=$film->field(array('id','title','f_cata','user','title','dt'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
				
			}
			
			$this->assign('mulu',$mulu);
			$this->assign('news_count',$count);
			$this->assign('title','后台管理系统');
			$this->assign('film_list',$film_list);
			$this->assign('page_method',$show);
						
			$this->display();
			
		}
		else
		{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}	
	}
	
	
	function add(){
		header("Content-Type:text/html; charset=utf-8");
		$aa=$_POST['second'];
		$film=M('film');		
		if($film->create()){
			$film->title		=$_POST['subject'];
			$film->content	=$_POST['editorValue'];
			$film->f_cata	=$_POST['second'];
			$film->user      =session('login_username');
			$film->dt        =date("Y-m-d H:i:s");
					
			//将文章写入数据库
			if($film->add()){
				$this->success('视频添加成功，返回上级页面',U('Film/film_mag'));
			}else{
				$this->error('视频添加失败，返回上级页面');
			}
			
		}else{
			$this->error($film->getError());
		}	
	}
	
	
	/**
     * @函数	delete
     * @功能	删除文章
     */
	function delete(){		
    	$article=M('film');
		if($article->delete($_GET['id'])){
			$this->success('视频删除成功');
		}else{
			$this->error($article->getLastSql());
		}
	}
	
	
	
	
	/**
     * @函数	edit
     * @功能	删除文章
     */
	function edit(){
		header("Content-Type:text/html; charset=utf-8");
		if($_GET['id']){
			redirect(U('/Film/film_add/id/'.$_GET['id']),0, '编辑文章');
		}
	}
	
	/**
     * @函数	update
     * @功能	更新修改后的文章到数据库
     */
	public function update(){
		
		header("Content-Type:text/html; charset=utf-8");	
		$article=M('film');		
	
		$data = array('title'=>$_POST['subject'],'content'=>$_POST['editorValue'],'dt'=>date("Y-m-d H:i:s"));		
		$id=$_POST['id'];
		if($article->where('id='.$id)->setField($data))
		{
			$this->success('修改成功',U('Film/film_mag'));	
		} // 根据条件保存修改的数据
		else
		{
			$this->error($article->getLastSql());
		}
		
	}
	
	//其他链接
	function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Login/index'),0, '重新登录');
    }
	
	function lis(){
		redirect(U('/Article/lis/'));
	}
	
	function index(){
		redirect(U('/Article/index/'));
	}
	
	function tzlis(){
		redirect(U('/Inform/tzlis/'));
		
	}
	
	function add_tz(){
		redirect(U('/Inform/add_tz/'));
	}
	
	function classname()
	{
		redirect(U('/Classname/classname'),0, '学生管理');
	}
	
	function add_class()
	{
		redirect(U('/Classname/add_class'),0, '添加班级');	
	}
	
	function class_lis(){
		redirect(U('/Classname/class_lis'),0, '班级管理');		
	}
	
	function catalog(){
		redirect(U('/Index/catalog'),0, '班级管理');
	}
	
	function add_second(){
		redirect(U('/Index/add_second'),0, '班级管理');
	}
	
	function link(){
		redirect(U('/Index/link'),0, '友情链接');
	}
	
	function teachername(){
		redirect(U('/Classname/teachername'),0, '添加用户');
	}
}

?>