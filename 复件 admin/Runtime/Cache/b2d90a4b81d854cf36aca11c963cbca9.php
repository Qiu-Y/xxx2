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
<style type="text/css">

#find{
	height:30px;
	width:100%;
	margin-bottom:10px;
	}
</style>
<script type="text/javascript">
	function getVal(){
		var i=0;
		var second=$("#second");
		$("option",second).remove();
		$.getJSON("__URL__/select",{name:$("#first").val()},function(json,status){
			if(!json)
			{
				alert("不存在数据");
			}
			else{
				for(i=0;i<json.data.length;i++)
				{
					var option = "<option value='"+json.data[i].f_cata+"'>"+json.data[i].f_cata+"</option>";
                    second.append(option);
					//alert(json.data[i].s_cata);
				}
				
			}
		});
	}
$().ready(function(){
		getVal();
		$("#first").change(function(){
			getVal();
		});
		
	});
</script>
</head>

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
     		<!-- 类型为nav-top-itrm current 表示选中时的样式 -->
     		 <li> <a href="#" class="nav-top-item current">新闻管理</a>
	          <ul>
	            <li><a href="__URL__/index">新闻添加</a></li>
	            <li><a class="current" href="__URL__/lis">新闻修改</a></li>
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
	            <li><a href="__URL__/student">学生管理</a></li>
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
    
    <div id="find">
        <form action="__URL__/lis" method="get">
            类别:
            
            
            <select name="select" id="first">
                <?php if(is_array($mulu)): $i = 0; $__LIST__ = $mulu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mm): $mod = ($i % 2 );++$i;?><option value="<?php echo ($mm['f_cata']); ?>"><?php echo ($mm['f_cata']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="second" id="second">
                </select>
                
            <input type="submit" value="查询" style="width:60px; height:30px; margin-left:100px;"/>
        </form>
     </div>
        
    <div class="content-box">
        
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3></h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">文章列表(共<?php echo ($news_count); ?>篇)</a></li>
          <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
      <div></div>
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <!--<div class="notification attention png_bg"> <a href="#" class="close"><img src="__PUBLIC__/Images/admin/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>您好，<?php echo ($username); ?>，下面是最近添加的文章！ </div>
          </div>-->
          
          <!-- 表头 -->
          <table>
            <thead>
              <tr>
                <th>
                 
                </th>
                <th>文章标题</th>
                <th>父目录</th>
                <th>子目录</th>
                <th>添加时间</th>
                <th>加入人员</th>	 
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td></td>
                <td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" title="title"><?php echo ($vo['title']); ?></a> </td>
                <td><?php echo ($vo['f_catalog']); ?></td>
                <td><?php echo ($vo['Catalog']); ?></td>
                <td><?php echo ($vo['dt']); ?></td>
                <td><?php echo ($vo['user']); ?> </td>
                <td>
                  <!-- Icons -->
                  <a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" title="编辑"><img src="__PUBLIC__/Images/admin/icons/pencil.png" alt="编辑" /></a> 
                  <a href="__URL__/delete/id/<?php echo ($vo['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> 
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                  <div class="pagination">               	  
                  	<?php echo ($page_method); ?>
                  <!--
                  	<a href="#" title="First Page">&laquo; First</a>
                  	<a href="#" title="Previous Page">&laquo; Previous</a> 
                  	<a href="#" class="number" title="1">1</a> 
                  	<a href="#" class="number" title="2">2</a> 
                  	<a href="#" class="number current" title="3">3</a> 
                  	<a href="#" class="number" title="4">4</a> 
                  	<a href="#" title="Next Page">Next &raquo;</a>
                  	<a href="#" title="Last Page">Last &raquo;</a> 
                  -->
                  </div>                 
                  <div class="clear"></div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        
        
        
        <!-- End #tab1 -->
        
      </div>
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