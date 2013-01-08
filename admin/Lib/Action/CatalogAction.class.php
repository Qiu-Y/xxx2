<?php
/**
     * @类		IndexAction
     * @功能	后台首页控制器
*/
class CatalogAction extends Action {	
	/**
     * @函数	index
     * @功能	显示后台管理主页面（包含登录判断）
     */
    public function index(){ 	
        header("Content-Type:text/html; charset=utf-8");
		if(session('?login_username')){
			$this->assign('username',session('login_username'));
			//实例化文章模型'
			$news=M('catalog');				
			$count=$news->count();
			$news_list=$news->field(array('id','f_cata','s_cata','isf','f_id','p_id'))->select();	
			$this->assign('news_count',$count);
			$this->assign('title','后台管理系统');
			$this->assign('news_list',$news_list);
			$this->assign('page_method',$show);
						
			$this->display();
			
		}
		
		else
		{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}	
    }
	
	function add(){
		$name=$_POST['catalog'];
		if($name=="")
		{
			$this->error("内容不能为空");
		}
		else if(strlen($name)>4)
		{
			$this->error("主目录不能超过四个字符");	
		}
		else
		{
			$catalog=D('Catalog');
			if($catalog->create())
			{
				echo "<script>alert('aa')</script>";
			}
			
			$news=M('catalog');	
			$news_list=$news->field(array('id','f_cata','s_cata','isf','f_id','p_id'))->where('isf=0')->select();
			if($news_list)
			{
				echo "<script>alert('$news_list')</script>";
			}
			/*if($news->create())
			{
				echo "<script>alert('aa')</script>";
				$add->f_cata=$name;
				$add->f_id=0;
				if($catalog->add())
				{
					$this->success("目录添加成功！");	
				}
				else
				{
					$this->error("数据添加失败");	
				}
				
			}
			else
			{
				$this->error("数据库读取失败");	
			}*/
				
		}
		
	}
  
	
	function lis(){
		header("Content-Type:text/html; charset=utf-8");

		if(session('?username')){
			$this->assign('username',session('login_username'));

		
			//实例化文章模型
			$news=M('cata');	
			$count=$news->count();
		
			//分页显示文章列表，每页8篇文章
			import('ORG.Util.Page');
			$page=new Page($count,12);//后台管理页面默认一页显示8条文章记录
	
            $page->setConfig('prev', "&laquo; Previous");//上一页
            $page->setConfig('next', 'Next &raquo;');//下一页
            $page->setConfig('first', '&laquo; First');//第一页
            $page->setConfig('last', 'Last &raquo;');//最后一页	
			$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
            //设置分页回调方法
			$show=$page->show();
	
			$news_list=$news->field(array('id','title','Catalog','user','title','dt'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
			
			//对原始信息过滤
			$this->filter(&$news_list);
			
			$this->assign('news_count',$count);
			$this->assign('title','后台管理系统');
			$this->assign('news_list',$news_list);
			$this->assign('page_method',$show);
						
			$this->display();
			
		}
		else
		{
			$this->error('您好，请先登录！！！',U('/Login/index/'));
		}	
	}
    
    /**
     *其他链接
     */
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
	function film_add(){
		redirect(U('/Film/film_add'),0, '视频添加');
	}
	
	function film_mag(){
		redirect(U('/Film/film_mag'),0, '视频添加');
	}
	
	
    
  /**
     * @函数	article
     * @功能	编辑新的文章
     */
    function article(){
    	//跳转
    	redirect(U('/Article/index'),0, '显示页面');
    } 
    /**
     * @函数	delete
     * @功能	删除文章
     */
    function delete(){
    	
    	//跳转至Article控制器来实现
    	if($_GET['id']){
    		redirect(U('/Article/delete/id/'.$_GET['id']),0, '删除文章');
    	}
    	else{
    		$this->error('参数错误！');
    	}
    }
    
    /**
     * @函数	edit
     * @功能	编辑文章
     */
    function edit(){
    	if($_GET['id']){
    		redirect(U('/Article/edit/id/'.$_GET['id']),0, '编辑文章');
    	}
    	else{
    		$this->error('参数错误！');
    	}
    } 
    
/*--------------------------------------------------内部方法-------------------------------------------------------------------*/    
     /**
     * @函数	filter
     * @功能	对数据库中的信息进行裁剪和过滤
     */ 
    private function filter($list){
    		
    	foreach($list as $key=>$value){			
   			//设置显示的创建时间
			$list[$key]['createtime']=date("Y-m-d H:i:s",$value['createtime']);
				
			//设置显示的最后修改时间
			if(!$value['lastmodifytime']){
				$list[$key]['lastmodifytime']="无";
			}else{
				$list[$key]['lastmodifytime']=date("Y-m-d H:i:s",$value['lastmodifytime']);
			}		
			
			//文章标题过长时裁剪
			if(strlen($list[$key]['subject'])>80){
					$list[$key]['subject']=$this->cutString($list[$key]['subject'],0,20).'...';				
			}
		}
    }
    
     /**
     * @函数	cutString
     * @功能	字符串裁剪(仅适用于UTF-8)
     */	
	private function cutString($str, $from, $len)
	{
   		return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
	}
}

