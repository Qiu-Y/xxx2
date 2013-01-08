<?php
/**
     * @类		IndexAction
     * @功能	后台首页控制器
*/
class InformAction extends Action {	
	public function tzlis(){
		header("Content-Type:text/html; charset=utf-8");

		if(session('?login_username')){
			$this->assign('username',session('login_username'));

		
			//实例化文章模型
			$news=M('tongzhi');	
			$count=$news->count();
		
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
	
			$news_list=$news->field(array('id','title','content','name','dt','display'))->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
			
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
	
	function add_tz()
	{
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','通知');
		$tongzhi=M('tongzhi');
		if($id=(int)$_GET['id']){
			$tongzhi_item=$tongzhi->where("id=$id")->find();	
			$this->assign('tongzhi_item',$tongzhi_item);	
			
			$this->assign('btn_ok_text','更新');
			$this->assign('btn_ok_act','update');
		}
		else{
			$this->assign('btn_ok_act','add');
			$this->assign('btn_ok_text','添加');
			
		}
		$this->display();	
	}
	
	function add()
	{
		header("Content-Type:text/html; charset=utf-8");
		$aa=$_POST['subject'];
		$article=D('Tongzhi');		
		if($article->create()){
			$article->title	=$_POST['subject'];
			$article->content	=$_POST['editorValue'];
			$article->name      =session('username');
			$article->dt        =date("Y-m-d H:i:s");
					
			//将文章写入数据库
			if($article->add()){
				//$url="http://sms.api.bz/fetion.php?username=您的移动飞信登录手机号&password=您的移动飞信登录密码&sendto=接收短信的飞信好友手机号&message=短信内容";
//				$result = file_get_contents($url); 
//				echo $result;
				$ret = file_get_contents('http://quanapi.sinaapp.com/fetion.php?u=18762099256&p=yyh103527&to=13800000000&m=测试内容');

				$retArray = json_decode($ret, true);
				
				var_dump($retArray);

				
				
				
				
				$this->success('文章添加成功，返回上级页面',U('Inform/tzlis'));
			}else{
				$this->error('文章添加失败，返回上级页面');
			}
			
		}
		else{
			$this->error($article->getError());
		}	
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$aa=$_POST['subject'];
		$article=D('Tongzhi');		
		if($article->create()){
			$article->title	=$_POST['subject'];
			$article->content	=$_POST['editorValue'];
			$article->name      =session('username');
			$article->dt        =date("Y-m-d H:i:s");
					
			//将文章写入数据库
			if($article->add()){
				$this->success('文章添加成功，返回上级页面',U('Inform/tzlis'));
			}else{
				$this->error('文章添加失败，返回上级页面');
			}
			
		}
		else{
			$this->error($article->getError());
		}	
	}
	
    
    
    function delete(){
    	
    	//跳转至Article控制器来实现
    	if($_GET['id']){
    		$article=M('tongzhi');
			if($article->delete($_GET['id'])){
				$this->success('文章删除成功');
			}else{
				$this->error($article->getLastSql());
			}
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
    		redirect(U('/Inform/add_tz/id/'.$_GET['id']),0, '编辑文章');
    	}
    	else{
    		$this->error('参数错误！');
    	}
    } 
	
	
	
	/**
     * 其他链接
     */
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Login/index'),0, '重新登录');
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
		redirect(U('/Index/catalog'),0, '班级管理');
	}
	
	function add_second(){
		redirect(U('/Index/add_second'),0, '班级管理');
	}
	
	function link(){
		redirect(U('/Index/link'),0, '友情链接');
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
	
	function teachername(){
		redirect(U('/Classname/teachername'),0, '添加用户');
	}
	
	function film_add(){
		redirect(U('/Film/film_add'),0, '视频添加');
	}
	
	function film_mag(){
		redirect(U('/Film/film_mag'),0, '视频添加');
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

