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

<style type="text/css">
#form form{
	margin-left:10px;
	}

</style>

<script type="text/javascript">	
function show($id)
{
	$.blockUI({    //当点击事件发生时调用弹出层
             message:$('#box'),    //要弹出的元素box

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
	$.ajax({ 
                url: '__URL__/article', 
                cache: false, 
                complete: function() { 
                    $.blockUI(); 
                } 
     }); 
	$('.blockOverlay').attr('title','单击关闭').click($.unblockUI);   //遮罩层属性的设置以及当鼠标单击遮罩层可以关闭弹出层
    $('.close').click($.unblockUI);  //也可以自定义一个关闭按钮来关闭弹出层
}

//$(function(){
//$('#box_btn').click(function(){   //给box_btn绑定一个鼠标点击的事件
//        $.blockUI({    //当点击事件发生时调用弹出层
//             message: $('#box'),    //要弹出的元素box
//
//             css: {    //弹出元素的CSS属性
//                 top: '50%',
//				 left: '50%',
//				 textAlign: 'left',
//				 marginLeft: '-320px',
//				 marginTop: '-145px',
//                 width: '600px',
//                 background: 'none'
//            }
//        });
//		$.ajax({ 
//                url: 'wait.php', 
//                cache: false, 
//                complete: function() { 
//                    // unblock when remote call returns 
//                    $.unblockUI(); 
//                } 
//            }); 
//    $('.blockOverlay').attr('title','单击关闭').click($.unblockUI);   //遮罩层属性的设置以及当鼠标单击遮罩层可以关闭弹出层
//    $('.close').click($.unblockUI);  //也可以自定义一个关闭按钮来关闭弹出层
//});
//});
</script>


<body>
<div id="body-wrapper">
  <div id="box" style="display:none;cursor:default;">
  <div id="form" style="width:100%; height:30px;"></div>
       <form action="__URL__/add_second" method="post">
            <input type="text" name="second_name" /><br />
            <input type="submit" value="添加" />
       </form>
  </div>
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
	            <li><a href="__URL__/student">学生管理</a></li>
                <li><a href="__URL__/teachername">后台用户</a></li>
	          </ul>
	        </li>
	        
	        <li> <a href="#" class="nav-top-item current">目录管理</a>
	          <ul>
	            <li><a class="current" href="#">修改目录</a></li>
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
 <div id="tt">
 <form action="__URL__/addcatalog" method="post">
 <img src="__PUBLIC__/Images/admin/ico.png" width="20" height="20" /><font style="font-size:14px; color:#333; font-weight:bold;">一级目录名称：</font><input type="text" id="text" name="catalog" style="width:260px; height:20px;" maxlength="100"/><input type="submit" value="添加" />
 </form>
 </div>
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    
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
                <th>一级目录</th>
                <th>二级目录</th>
                <th>三级目录</th>
                <th>属性</th>
                <th>选项</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
			  <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["f_id"]) == "0"): ?><tr>
                    <td></td>
                    <td><?php echo ($vo['f_cata']); ?></td>
                    <td></td>
                    <td></td>
                    <td>
                    
                    </td>
                    <td>
                      <a href="__URL__/edit_catalog/id/<?php echo ($vo['id']); ?>" title="编辑"><img src="__PUBLIC__/Images/admin/icons/pencil.png" alt="修改" /></a> 
                      <a href="__URL__/delete_catalog/id/<?php echo ($vo['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a>
                      <a href="__URL__/add_second/id/<?php echo ($vo['id']); ?>" title="添加二级目录">添加二级目录</a> 
                    </td>
                  </tr>  
                  <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i; if(($sub["f_id"]) == $vo["id"]): ?><tr>
                        <td></td>
                        <td><a href="__URL__/edit/id/<?php echo ($vo['id']); ?>" title="title"></a> </td>
                        <td><?php echo ($sub['f_cata']); ?></td>
                        <td></td>
                        <td>
                        <?php
 if($sub['isf']==1){ ?>
                            视频
                            <?php  } else{ ?>
                            文档
                            <?php  } ?>
                        </td>
                        <td>
                          <a href="__URL__/edit_catalog/id/<?php echo ($sub['id']); ?>" title="编辑"><img src="__PUBLIC__/Images/admin/icons/pencil.png" alt="修改" /></a> 
                          <a href="__URL__/delete_catalog/id/<?php echo ($sub['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> 
                          <a href="__URL__/add_second/id/<?php echo ($sub['id']); ?>" title="添加三级目录">添加三级目录</a> 
                        </td>
                      </tr>
                      <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$third): $mod = ($i % 2 );++$i; if(($third["f_id"]) == $sub["id"]): ?><tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo ($third['f_cata']); ?></td>
                            <td></td>
                            <td>
                              <a href="__URL__/edit_catalog/id/<?php echo ($third['id']); ?>" title="编辑"><img src="__PUBLIC__/Images/admin/icons/pencil.png" alt="修改" /></a> 
                              <a href="__URL__/delete_catalog/id/<?php echo ($third['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> 
                            </td>
                          </tr><?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                  <div class="pagination">               	  
                  	<?php echo ($page_method); ?>
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