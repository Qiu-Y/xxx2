<?php
require("Public/phpmailer/class.phpmailer.php");
class ShowAction extends Action {
   
	public function index(){
		if(trim(session('username'))!='')
		{
			header("Content-Type:text/html; charset=utf-8");
			//目录
			$news=M('catalog');
			$news_list=$news->field(array('id','f_cata','isf','f_id','p_id'))->order('id asc')->select();
				
			//身份
			$this->assign('shenfen',session('shenfen'));
			$this->assign('news_list',$news_list);
			$this->assign('link_list',$link_list);	
			$this->assign('title','信号与系统');
			$this->assign('tongzhi_list',$tongzhi_list);
			
			$this->assign('username',session('username'));
			$this->display();
		}
		else{
			redirect(U('/Index/index'));
		}

	}
	function show_cata(){
		if(trim(session('username'))!='')
		{
			header("Content-Type:text/html; charset=utf-8");
			$id=$_GET["id"];
			$catalog=M('catalog');
			if($cata_f=$catalog->where("f_id='".$id."'")->select())
			{
				
			}
			else {
			
			}
		}
		else
		{
			redirect(U('/Index/index'));
		}
	}
	
	function show(){
		header("Content-Type:text/html; charset=utf-8");
//		$id=iconv("gb2312","utf-8",$_GET["id"])
		if($id=trim($_GET["id"]))
		{
			$catalog=M('catalog');
			if($catalog_list=$catalog->where("f_cata='".$id."'")->find())
			{
				if($catalog_list['isf']==0){
					
					$cata=M('cata');
					$content_list=$cata->where("Catalog='".$id."'")->field(array('title','content','user','dt'))->select();
					$pageid=$content_list['id'];
					$this->assign('content_list',$content_list);
				}
				else{
					redirect(U('/Show/videos/id/'.$id));
				}
			}
			else{
				echo "<script>alert('参数错误')</script>";	
			}
			$this->display();
			
		}
		else{
			redirect(U('/Show/welcome'));
		}
	}
	
	function welcome(){
		$this->display();
		
	}
	
	function room(){
		if($id=trim($_GET["username"]))	
		{
			$login=M('login');
			if($login->where("username='".$id."'")->find())
			{
				redirect(U('/Room/index/'));	
			}
			else{
				redirect(U('/Sroom/index/'));	
			}
		}
	}
	
	function videos(){
		
		if($title=trim($_GET['id']))
		{
			$catalog=M('catalog');
			if($catalog_list=$catalog->where("f_cata='".$title."'")->find())
			{
				$aa=$catalog_list['id'];
				$clog=$catalog->where("f_id=".$aa)->select();
				
			}
			$this->assign('clog',$clog);
			$this->assign('title',$title);
			$this->display();
		}
		else if($title=trim($_GET['f_title'])){
			$catalog=M('catalog');
			if($catalog_list=$catalog->where("f_cata='".$title."'")->find())
			{
				$aa=$catalog_list['f_id'];
				$clog=$catalog->where("f_id=".$aa)->select();
				
			}
			$this->assign('clog',$clog);
			$this->assign('title',$title);
			$this->display();
		}
		else{
			$this->error("参数错误！");
		}
	}
	
	function de_videos(){
		
		if($f_cata=trim($_GET['title']))
		{
			$film=M('film');
			if($film_list=$film->where("f_cata='".$f_cata."'")->select())
			{
				$this->assign('film_list',$film_list);
				
			}
			$this->assign('title',$f_cata);
			$this->display();
		}
		else if($f_cata=trim($_GET['m_title']))
		{
			
			$film=M('film');
			if($film_temp=$film->where("title='".$f_cata."'")->find())
			{
				$title=$film_temp['f_cata'];
				if($film_list=$film->where("f_cata='".$film_temp['f_cata']."'")->select())
				$this->assign('film_list',$film_list);
				
			}
			$this->assign('cn',$f_cata);
			$this->assign('title',$title);
			$this->display();
		}
		else{
			$this->error("参数错误！");
		}
	}
	
	function show_video(){
		if($title=trim($_GET['title']))
		{
			$film=M('film');
			if($film_list=$film->where("title='".$title."'")->find())
			{
				$this->assign('film_list',$film_list);
				
			}
			$this->assign('cn',$f_cata);
			$this->assign('title',$title);
			$this->display();
		}
		else{
			$this->error("参数错误！");
		}
	}
	
	

}