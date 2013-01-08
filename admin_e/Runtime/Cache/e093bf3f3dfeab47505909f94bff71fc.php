<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>


<link rel="stylesheet" href="__PUBLIC__/Css/admin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/invalid.css" type="text/css" media="screen" />

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.blockUI.js"></script>
<style>
#ceng p.fir{
	margin-top:10px;
	}
#ceng p
{
	text-indent:20px;
	}

</style>
<script type="text/javascript">
$(function(){
	
	$(".name").click(function(){
		$title=this.title;
		$title_array=$title.split(',');
		$content="<div id='ceng'>";
		$content+="<p class='fir'>姓名:"+$title_array[0]+"</p>";
		$content+="<p>学号:"+$title_array[2]+"</p>";
		$content+="<p>联系方式:"+$title_array[1]+"</p>";
		$content+="</div>";
		$.blockUI({    //当点击事件发生时调用弹出层
             message:$content,    //要弹出的元素box

             css: {    //弹出元素的CSS属性
                 top: '50%',
				 left: '50%',
				 textAlign: 'left',
				 marginLeft: '-320px',
				 marginTop: '-145px',
				 width:'360px',
				 height:'160px',
                 background: 'white'
            }
        });
		$('.blockOverlay').attr('title','单击关闭').click($.unblockUI);   //遮罩层属性的设置以及当鼠标单击遮罩层可以关闭弹出层
    	$('.close').click($.unblockUI);  //也可以自定义一个关闭按钮来关闭弹出层
		
		});
	});
</script>

<body>
<div id="body-wrapper">

  <div id="sidebar">
    <div id="sidebar-wrapper">
     
      	<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      	<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="Simpla Admin logo" />

      	<div id="profile-links"> 
      		<a href="__URL__/in" title="首页">首页</a> 
      		您好,<a href="#" title="当前用户:<?php echo ($username); ?>"><?php echo ($username); ?></a> |
	 		<a href="__URL__/quit" title="退出">退出</a> 
       	</div>
       	
	    <ul id="main-nav">
     		<li> <a href="#" class="nav-top-item">新闻管理</a>
	          <ul>
	            <li><a href="__URL__/add_news">新闻添加</a></li>
	            <li><a href="__URL__/lis">新闻修改</a></li>
	          </ul>
	        </li>
             
            <li> <a href="#" class="nav-top-item">视频</a>
	          <ul>
                <li><a href="__URL__/film_mag">视频管理</a></li>
	            <li><a href="__URL__/film_add">视频添加</a></li>
	            
	          </ul>
	        </li>
            
            <li> <a href="#" class="nav-top-item current">用户管理</a>
	          <ul>
	            <li><a class="current" href="#">添加班级</a></li>
                <li><a href="__URL__/class_lis">班级管理</a></li>
	            <li><a href="__URL__/classname">学生管理</a></li>
                <li><a href="__URL__/teachername">后台用户</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item">模块管理</a>
	          <ul>
	            <li><a href="__URL__/catalog">修改目录</a></li>
	            <li><a href="__URL__/add_second">添加二级目录</a></li>
	          </ul>
	        </li>
	              
	        <li> <a href="#" class="nav-top-item">通知管理</a>
	          <ul>
	            <li><a href="__URL__/tzlis">通知修改</a></li>
	            <li><a href="__URL__/add_tz">通知添加</a></li>
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
  <!-- End #sidebar -->
  
  
  
  
  <div id="main-content">
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    <p><font style="font-size:14px; font-weight:bold;">班级添加</font></p>
    <div class="content">
    
      <!-- Start Content Box -->
      <form action="__URL__/<?php echo ($btn_ok_act); ?>" method="post">
      	<table style="background:#FFF;">
        <tr>
        	<td width="60">班级名称</td><td><input type="text" name="classname" value="<?php echo ($class_item["classname"]); ?>" /></td><td></td>
        </tr>
        <tr>
        	<td>班主任</td><td><input type="text" name="teacher"  value="<?php echo ($class_item["teacher"]); ?>" /></td><td></td>
        </tr>
        <tr>
        	<td>人数限制</td><td><input type="text" name="amount"  value="<?php echo ($class_item["amount"]); ?>" /></td><td></td>
        </tr>
        </table>
        <input style="width:50px; height:30px;" type="hidden" value="<?php echo ($class_item["id"]); ?>" name="id"/>
		<input style="width:50px; height:30px;" type="submit" value="<?php echo ($btn_ok_text); ?>"/>
      </form>
      <!-- End .content-box-content -->
    </div>
    <div class="clear"></div>
   

    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2010 Your Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>