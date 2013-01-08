<?php
define('SD_ROOT','public/Uploads/header');
require("Public/phpmailer/class.phpmailer.php");
include("Public/PHPExcel.php");
include("Public/lib/PHPFetion.php");

class pic_data
{
	 public $data;
	 public $status;
	 public $statusText;
	public function __construct()
	{
		$this->data->urls = array();
	}
}
class SroomAction extends Action {
   
	public function index(){
		if(trim(session('username'))!='')
		{
			header("Content-Type:text/html; charset=utf-8");
			$username=session('username');
					
			$teacher=M('teacher');
			if($teacher_list=$teacher->where("username='".$username."'")->find())
			{
				$login_name=$teacher_list['name'];
				session('name',$login_name);
				$this->assign('link',$teacher_list['p_b_img']);
				$this->assign('login_name',$login_name);
				$this->display();
			}
			else{
				redirect(U('/Index/index'));
			}
			
		}
		else{
			redirect(U('/Index/index'));
		}

	}
	
	function basic_info(){
		
			header("Content-Type:text/html; charset=utf-8");
			$username=session('username');
			$login=M('teacher');
			if($basic_info=$login->where("username='".$username."'")->find())
			{		
				$teacher=M('class');
				$teacher_class=$teacher->where("teacher='".$basic_info['name']."'")->select();
			}
			
			$this->assign('basic_info',$basic_info);
			$this->assign('teacher_class',$teacher_class);
			$this->display();
	
	}
	
	function room(){
		if($id=trim($_GET["username"]))	
		{
			redirect(U('/Room/index/'));
				
		}
	}
	
	function update(){
		$username=$_POST['username'];
		$data['qq']=$_POST['qq'];
		$data['e_mail']=$_POST['mail'];
		$data['phone']=$_POST['phone'];
		$data['addr']=$_POST['addr'];
		if((trim($data['qq'])=='')&&(trim($data['e_mail'])=='')&&(trim($data['phone'])=='')&&(trim($data['addr'])==''))
		{
			echo "<script>alert('不能都为空')</script>";
			redirect(U('/Sroom/basic_info/'));
		}
		else
		{
			$teacher = M("teacher");
			if($teacher->where("name='".$username."'")->save($data))
			{
				redirect(U('/Sroom/basic_info/'));
			}
			else
			{
				redirect(U('/Sroom/basic_info/'));
			}
			
		}
	}

	function short_msg(){
		if(trim(session('username'))!='')
		{
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
			
			$this->assign('page_method',$show);
			$this->assign('msg_list',$msg_list);
			$this->display();
		}
		else{
			redirect(U('/Sroom/basic_info/'));
		}
	}
	
	function report(){
		
		$name=session('name');
		
		$class=M('class');
		
		$class_list=$class->where("teacher='".$name."'")->select();
		
		$login=M('login');
		
		$person=$login->select();
		


		$this->assign('class_list',$class_list);
		
		$this->assign('person',$person);
		
		$this->display();
		

	}
	
	function reportmsg(){
		//引入飞信方法
		$fetion = new PHPFetion('18762099256', 'yyh103527');	// 手机号、飞信密码
		
		$name=$_POST['total_name'];
		
		$name_list=explode(',',$name);
		
		$data['from_name']=session('name');
		
		$login=M('login');
		
		$msg=M('msg');
		
		foreach($name_list as $value)
		{
			if(trim($value)!='')
			{
				$data['to_name']=$value;
				
				$data['content']=$_POST['editorValue'];
				
				$data['time']=date("Y-m-d H:i:s");
				
				if($p=$login->where("name='$value'")->find()){
					if(!empty($p['phone'])){
						$message = iconv('gbk', 'utf-8',$data['content']);
						$fetion->send($p['phone'],$message );
					}
				}
				
				if($msg->add($data)){
					continue;
				}
				else {
					$this->error('发送失败，请重新发送！');
					exit;
				}
			}
		}
	}
	
	//密码修改 start
	function change_pwd(){
		$username=session('username');
		
		$this->assign('username',$username);
		if($id=$_GET['id'])
		{
			
			$old_pwd=$_POST['old_pwd'];
			$pwd=$_POST['pwd'];
			$re_pwd=$_POST['re_pwd'];
			if($pwd==""||$re_pwd==""||$old_pwd=="")
			{
				$this->error('不能为空！');
			}
			else if($pwd!=$re_pwd)
			{
				$this->error('两次输入密码不同！');
			}
			else
			{
				if(trim(session('shenfen'))=='teacher')
				{
					$login=M('teacher');
					$login_list=$login->where("username='".$id."'")->find();
					$rel_pwd=$login_list['pwd'];
					if($old_pwd!=$rel_pwd)
					{
						$this->error('旧密码输入错误！');
					}
					else
					{
						$data=array('pwd'=>$pwd);
						if($login->where("username='".$id."'")->setField($data))
						{
							$this->success('密码修改成功');
						}
					}
				}
				else{
					
				}
	
			}
		}
		else {
			$this->display();
		}
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
	
	
	//短消息列表
	function msg_list(){
		$id=$_GET['id'];
		$msg=M('msg');
		$msg_list=$msg->where("id='".$id."'")->find();
		$this->assign('msg_list',$msg_list);
		
		$this->display();
	}
	
	//短消息回复
	function repeat(){		
		
		$id=$_GET['id'];
		
		$msg=M('msg');
		$data=array('repeat'=>$_POST['editorValue'],'statue'=>'1');
		if($msg->where('id='.$id)->setField($data))
		{
			$this->success('回复成功',U('Room/short_msg'));		
		}
		else{
			$this->error('出错');
		}
		
	}
	
	//布置作业
	function worklist(){
	
		$name=session('name');
		$work=M('work');
		$count=$work->where("name='".$name."'")->count();
		
		
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
		
		$work_list=$work->where("name='".$name."'")->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		
		$this->assign('page_method',$show);
		$this->assign('work_list',$work_list);
		$this->display();
	}
	
	function addwork(){
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','添加');
		$work=M('work');
		$teacher=M('class');
		$teacher_class=$teacher->where("teacher='".$basic_info['name']."'")->select();
		
		if($id=(int)$_GET['id']){
			
			$work_item=$work->where("id=$id")->find();	
			$this->assign('work_item',$work_item);
			$this->assign('class_name',$teacher_class);	
			
			$this->assign('btn_ok_text','更新');
			$this->assign('btn_ok_act','updatea');
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
		$work=M('work');		
		if($work->create()){
			$work->title	=$_POST['title'];
			$work->content	=$_POST['editorValue'];
			$work->name      =session('name');
			$work->time        =$_POST['datehm'];
			//灏嗘枃绔犲啓鍏ユ暟鎹簱
			if($id=$work->add()){
				$newdir = mkdir("public/work/".$id);
				if($newdir){
				echo "鎴愬姛";
				}
				else{
				echo "澶辫触";
				}
				//redirect(U('Sroom/worklist'));
			}else{
				$this->error('鏂囩珷娣诲姞澶辫触锛岃繑鍥炰笂绾ч〉闈�');
			}
			
		}
		else{
			$this->error($work->getError());
		}	
	}
	
	function updatea(){
		
		header("Content-Type:text/html; charset=utf-8");	
		$article=M('work');		
	
		$data = array('title'=>$_POST['title'],'content'=>$_POST['editorValue'],'time'=>$_POST['datehm']);		
		$id=$_POST['id'];
		if($article->where('id='.$id)->setField($data))
		{
			redirect(U('Sroom/worklist'));
		} // 鏍规嵁鏉′欢淇濆瓨淇敼鐨勬暟鎹�
		else
		{
			$this->error($article->getLastSql());
		}
		
	}
	
	function delete(){	
		if($_POST['id'])
		{
			echo "<script>alert('".$_POST['id']."')</script>";
			foreach($_POST['id'] as $i)
			{
				$login=M('login');
				if($login->where("id='".$i."'")->delete()){
					continue;
				}
				else{
					$this->error($login->getLastSql());
				}
			}
			redirect(U('Sroom/xlslist'));
		}
		else {
			if($_GET["_URL_"][2]=='work')
			{	
		    	$article=M('work');
				if($article->delete($_GET["_URL_"][4])){
					redirect(U('Sroom/worklist'));
				}else{
					$this->error($article->getLastSql());
				}
			}
			else if($_GET["_URL_"][2]=='login'){
				$login=M('login');
				if($login->where("id='".$_GET["_URL_"][4]."'")->delete()){
					redirect(U('Sroom/xlslist'));
				}else{
					$this->error($login->getLastSql());
				}
			}
		}

	}
	
	//鐝骇灞曠ず
	function classlist(){
		$name=session('name');
		$class=M('class');
		$count=$class->where("teacher='".$name."'")->count();

		//鍒嗛〉鏄剧ず鏂囩珷鍒楄〃锛屾瘡椤�8绡囨枃绔�
		import('ORG.Util.Page');
		$page=new Page($count,8);//鍚庡彴绠＄悊椤甸潰榛樿涓�椤垫樉绀�8鏉℃枃绔犺褰�

		$page->setConfig('prev', "&laquo; Previous");//涓婁竴椤�
		$page->setConfig('next', 'Next &raquo;');//涓嬩竴椤�
		$page->setConfig('first', '&laquo; First');//绗竴椤�
		$page->setConfig('last', 'Last &raquo;');//鏈�鍚庝竴椤�	
		$page->setConfig('theme',' %first% %upPage%  %linkPage%  %downPage% %end%');
		//璁剧疆鍒嗛〉鍥炶皟鏂规硶
		$show=$page->show();
		
		$class_list=$class->where("teacher='".$name."'")->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		
		
		$this->assign('page_method',$show);
		$this->assign('class_list',$class_list);
		$this->display();
	}
	
	function back(){
		session(null);
		redirect(U('Index/index'));
	}
	
	function head_img(){
		$this->display();	
	}
	
	
	//lead导入学生
	function lead(){
		static $classdata;
		if($id=$_GET['id'])
		{
			$class=M('class');
			if($classdata=$class->where("id='".$id."'")->find()){
				$this->assign('classdata',$classdata);
				$this->display();
			}
			else{
				$this->assign('classdata',$classdata);
				$this->error("出错");
			}	
		}
		else{
			$this->assign('classdata',$classdata);
			$this->display();
		}
	}
	
	function upxls(){
		
		
		$classname=$_POST['classname'];
		
		session('classname',$classname);
		
		//static $numid,$nameid,$telid,$sexid;
		//static $num,$name,$phone,$sex;
		$filename=$_FILES["filename"];
		
		$url=$filename['tmp_name'];
		
		$excel=PHPExcel_IOFactory::load($url);
		$sheet=$excel->getActiveSheet();
	
		//得到有几条数据
		$rows=$sheet->getHighestRow();
		
		$column=count($sheet->getColumnDimensions());
		
		for($i=0;$i<$column;$i++)
		{
			if(trim($sheet->getCellByColumnAndRow($i,1)->getValue())=='学号'){
				$numid=$i;
			}
			else if(trim($sheet->getCellByColumnAndRow($i,1)->getValue())=='姓名'){
				$nameid=$i;
			}
			else if(trim($sheet->getCellByColumnAndRow($i,1)->getValue())=='联系方式'){
				$telid=$i;
			}
			else if(trim($sheet->getCellByColumnAndRow($i,1)->getValue())=='性别')
			{
				$sexid=$i;
			}
		}
		$login=M("login");
		for($i=2;$i<=$rows;$i++){
			$num=$sheet->getCellByColumnAndRow($numid,$i)->getValue();
			$name=$sheet->getCellByColumnAndRow($nameid,$i)->getValue();
			
			$sex=$sheet->getCellByColumnAndRow($sexid,$i)->getValue();
			if(!empty($telid))
			{
				$phone=$sheet->getCellByColumnAndRow($telid,$i)->getValue();
			}
			if($sex=='男'){
				$sex='MR';
			}
			else{
				$sex='MRS';
			}

			$login->num=$num;
			$login->pwd=md5($num);
			$login->name=$name;
			$login->phone=$phone;
			$login->sex=$sex;
			$login->clas=$classname;

			if($login->where("num='$num'")->find()){
				continue;
			}
			else
			{
				if($lastid=$login->add())
				{
					$array_id[]=$lastid;
				}
				else{
					exit;
					echo "读入错误";
				}
			}
			$data[]=array(
				'id'=>$lastid,
				'num'=>$num,
				'name'=>$name,
				'phone'=>$phone,
				'sex'=>$sex
			);
			
		}
		if(empty($array_id)){
			echo "不存在数据";
		}
		else{
			redirect(U('Sroom/xlslist'));
		}
		
		
	}
	
	function xlslist(){
		
		$classname=session('classname');
		$login=M("login");
		if($data=$login->where("clas='$classname'")->select())
		{
			$this->assign('data',$data);
			$this->display();
		}
		else{
			$this->error('不存在该班级学生');
		}
	}
	
	
	
	
	//澶村儚涓婁紶
	function upload(){

            @header("Expires: 0");
            @header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
            @header("Pragma: no-cache");
           // define('SD_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
            $pic_id = com_create_guid();
            //$pic_path = SD_ROOT.'./Public/Uploads/header/avatar_origin/'.$pic_id.'.jpg';
			$pic_path = 'public/Uploads/header/avatar_origin/'.$pic_id.'.jpg';

            //$pic_abs_path = 'http://sns.com/avatar_test/avatar_origin/'.$pic_id.'.jpg';
            $pic_abs_path = '/xxx2/public/Uploads/header/avatar_origin/'.$pic_id.'.jpg';

			$file = @$_FILES['Filedata']['tmp_name'];
            if(empty($_FILES['Filedata'])) {
                    echo '<script type="text/javascript">alert("对不起, 图片未上传成功, 请再试一下");</script>';
                    exit();
            }

            file_exists($pic_path) && @unlink($pic_path);

            if(@copy($_FILES['Filedata']['tmp_name'], $pic_path) || @move_uploaded_file($_FILES['Filedata']['tmp_name'], $pic_path)) 
            {
                    @unlink($_FILES['Filedata']['tmp_name']);
            } else {
                    @unlink($_FILES['Filedata']['tmp_name']);
                    echo '<script type="text/javascript">alert("对不起, 上传失败");</script>';
            }

            echo '<script type="text/javascript">window.parent.hideLoading();window.parent.buildAvatarEditor("'.$pic_id.'","'.$pic_abs_path.'","photo");</script>';
     }
	
	function save()
	{

            @header("Expires: 0");
            @header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
            @header("Pragma: no-cache");


            $type = isset($_GET['type'])?trim($_GET['type']):'small';
			$pic_id = trim(session('username'));


            $new_avatar_path = 'avatar_'.$type.'/avatar_'.$pic_id.'.jpg';
			$len = file_put_contents(SD_ROOT.'./'.$new_avatar_path,file_get_contents("php://input"));

            $avtar_img = imagecreatefromjpeg(SD_ROOT.'./'.$new_avatar_path);
            imagejpeg($avtar_img,SD_ROOT.'./'.$new_avatar_path,80);

            
            $url='/public/Uploads/header/avatar_big/avatar_'.$pic_id.'.jpg';
            
            $login=M('login');
            
			$teacher = M("teacher");
			$data['p_b_img']=$url;
			$data['p_s_img']='/public/Uploads/header/avatar_small/avatar_'.$pic_id.'.jpg';
			
			$teacher->where("username='".$pic_id."'")->save($data);
			
			$d =new pic_data();
			
            $d->data->urls[0] = $url;
            
            $d->statusText = '上传成功!';
            
            $d->status = 1;
            
            
			/*if($teacher->where("username='".$pic_id."'")->save($data))
			{
			
			}
			else
			{
				
			}*/
			
            $msg = json_encode($d);
            echo $msg;
            log_result($msg);
            
            
            
	}
	
	function  log_result($word) {
		@$fp = fopen("/xxx2/public/Uploads/log.txt","a");	
		@flock($fp, LOCK_EX) ;
		@fwrite($fp,$word."：执行日期：".strftime("%Y%m%d%H%I%S",time())."\r\n");
		@flock($fp, LOCK_UN); 
		@fclose($fp);
	}
	
	
	
	
	
	
	

}