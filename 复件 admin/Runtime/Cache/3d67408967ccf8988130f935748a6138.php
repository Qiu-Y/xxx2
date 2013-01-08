<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>


<link rel="stylesheet" href="__PUBLIC__/Css/admin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>

<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_all.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_config.js"></script>




</head>

<body>
<div id="body-wrapper">

  <div id="sidebar">
    <div id="sidebar-wrapper">
      	<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="Simpla Admin logo" />

      	<div id="profile-links"> 
      		<a href="__URL__/in" title="首页">首页</a> 
      		您好,<a href="#" title="当前用户:<?php echo ($username); ?>"><?php echo ($username); ?></a> |
	 		<a href="__URL__/quit" title="退出">退出</a> 
       	</div>
       	
	    <ul id="main-nav">
     		<!-- 类型为nav-top-itrm current 表示选中时的样式 -->
     		 <li> <a href="#" class="nav-top-item">新闻管理</a>
	          <ul>
	            <li><a href="__URL__/article">新闻添加</a></li>
	            <li><a href="__URL__/lis">新闻修改</a></li>
	          </ul>
	        </li>
             
            <li> <a href="#" class="nav-top-item">视频</a>
	          <ul>
                <li><a href="__URL__/film_mag">视频管理</a></li>
	            <li><a href="__URL__/film_add">视频添加</a></li>
	            
	          </ul>
	        </li>
            
            <li> <a href="#" class="nav-top-item">用户管理</a>
	          <ul>
	            <li><a href="__URL__/add_class">添加班级</a></li>
                <li><a href="__URL__/class_lis">班级管理</a></li>
	            <li><a href="__URL__/classname">学生管理</a></li>
                <li><a href="__URL__/teachername">后台用户</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item">目录管理</a>
	          <ul>
	            <li><a href="__URL__/catalog">修改目录</a></li>
	            <li><a href="__URL__/add_second">添加二级目录</a></li>
	          </ul>
	        </li>
	              
	        <li> <a href="#" class="nav-top-item current">通知管理</a>
	          <ul>
	            <li><a href="__URL__/tzlis">通知修改</a></li>
	            <li><a class="current" href="#">通知添加</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item">其他 Others</a>
	          <ul>
	            <li><a href="__URL__/link">友情链接</a></li>
	            <li><a href="">出版物</a></li>
	          </ul>
	        </li>
	     </ul>
         
    </div>
  </div>
   
  <div id="main-content">
 
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> 您好，您的浏览器不支持JavaScript，请打开JavaScript功能 <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    
    <h2>通知</h2>
	<br></br>
	
   	<!-- 实例化百度编辑器 -->

   	<form action="__URL__/<?php echo ($btn_ok_act); ?>"  method="post">
   		<p class="subtit"><font style="font-size:14px; font-weight:bold;">标题：</font></p>
		<div>
			<input type="text" id="txtTitle" name="subject" style="width:560px; height:20px;" maxlength="100" value="<?php echo ($tongzhi_item["title"]); ?>"/>
		</div>
        <br/>
		<p class="subtit"><font style="font-size:14px; font-weight:bold;">内容：</font></p>
	    <div id="content">
			<script type="text/javascript">
				var editor = new baidu.editor.ui.Editor({
					minFrameHeight: 120,//初始化框架大小
					toolbars:[["bold","italic","undo","redo"]],
				    initialContent: '<?php echo ($tongzhi_item["content"]); ?>'
				});
				editor.render("content");
			</script>
		</div>
		<br></br>
		<input style="width:50px; height:30px;" type="hidden" value="<?php echo ($tongzhi_item["id"]); ?>" name="id"/>
		<input style="width:50px; height:30px;" type="submit" value="<?php echo ($btn_ok_text); ?>"/>
	</form>
    <div class="clear"></div>
        
    <div id="footer"> 
    	<small>
      		&#169; Copyright 2012 SIA | Powered by Ruby97 		| 	<a href="#">Top</a> 
      	</small> 
    </div>
    
  </div>

</div>
</body>
</html>