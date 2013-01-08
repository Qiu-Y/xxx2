<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta content="text/html; CHARSET=utf-8" http-equiv="Content-Type">	
<link rel="stylesheet" href="__PUBLIC__/Css/home/Outdoor.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/Css/home/show.css" type="text/css" />

<title><?php echo ($title); ?></title>


<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>


<style type="text/css">
#tongzhi{
	border:1px solid #895F30;
	}
#mq{
	height:94%;
	margin-top:5px;
	margin-left:5px;
	margin-right:5px;
	}
	


</style>


<!-- qy begin -->

<script>
function check(str)
{
	alert("aa");
	
	
}

</script>

<!-- qy end -->
</head>
<body>	
<div id="main_head">
	<p>欢迎光临<?php echo ($username); ?><span id="room"><img src="__PUBLIC__/Images/home/star.png" /><a href="__URL__/room/username/<?php echo ($username); ?>" target="_bank">个人空间</a></span><span id="msg"><img src="__PUBLIC__/Images/home/comments.png" />短消息<?php echo ($count); ?>条</span></p>
</div>
<!-- wrap starts here -->
<div id="wrap">

	<!--header -->
	<div id="header">			
		
		<div id="header-links">
			<p>
			<a href="__URL__/index">首页</a> | 
			<a href="__URL__/contact" target="details">联系</a> | 
			<a href="__URL__/index">English</a>			
			</p>		
		</div>				
		
	<!--header ends-->					
	</div>
	
	<div id="header-photo"><img src="__PUBLIC__/Images/home/header-photo.jpg" width="870" height="126" alt="header-photo" /></div>	
	
	<!-- navigation starts-->	
	<div  id="nav">
		<ul>
       		<li id="current"><a href="__URL__/index">首页</a></li>
        	<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["f_id"]) == "0"): ?><li><a href="" onClick="check(<?php echo ($vo['id']); ?>)"><?php echo ($vo['f_cata']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	<!-- navigation ends-->	
	</div>					
			
<!-- qy begin-->

	<!-- content-wrap starts -->
	<div id="side">
    <p>目录选项</p>
        <ul id="main-nav">
            <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["f_id"]) == "0"): ?><li> <a id="<?php echo ($vo['id']); ?>" href="#" class="nav-top-item"><?php echo ($vo['f_cata']); ?></a>
                              <ul id="sub-nav">
                                  <?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i; if(($sub["f_id"]) == $vo["id"]): ?><li><a href="__URL__/show/id/<?php echo ($sub['f_cata']); ?>" target="details"><?php echo ($sub['f_cata']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>  
                              </ul>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>   	
		

		<!--<div id="sidebar">
		</div>-->
		<!-- sidebar ends -->	
		
	<!-- content-wrap ends-->	
	</div>

		
<!--内嵌框架-->
	<!--<div id="Detail">-->
	<!--<iframe name="details" src="__URL__/welcome" frameborder="0" width="100%" height="100%"></iframe>-->
	<iframe id="ifm" name="details" src="__URL__/show" frameborder="0" scrolling="no" width="100%" onLoad="javascript:dyniframesize('ifm');"></iframe>
	<script language="javascript" type="text/javascript"> 
	function dyniframesize(down) { 
		var pTar = null; 
		if (document.getElementById)
		{ 
			pTar = document.getElementById(down); 
		} 
		else
		{ 
			eval('pTar = ' + down + ';'); 
		} 
		if (pTar && !window.opera)
		{ 
			//begin resizing iframe 
			pTar.style.display="block" 
			if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight)
			{ 
				//ns6 syntax 
				pTar.height = pTar.contentDocument.body.offsetHeight +20; 
				if(pTar.height<400)
				{
					pTar.height=400;
				}
				//pTar.width = pTar.contentDocument.body.scrollWidth+20; 
			} 
			else if (pTar.Document && pTar.Document.body.scrollHeight)
			{ 
				//ie5+ syntax 
				pTar.height = pTar.Document.body.scrollHeight; 
				if(pTar.height<400)
				{
					pTar.height=400;
				}
				//pTar.width = pTar.Document.body.scrollWidth; 
			} 
		} 
		} 
	
	</script>
	<!--</div>-->
<!--内嵌框架结束-->

<!-- qy end-->


	<!-- footer starts -->		
	<div id="footer-wrap">
	
		<div id="footer-columns">
	
			<div class="col3">
				<h3>友情链接</h3>
				<ul>
                	<?php if(is_array($link_list)): $i = 0; $__LIST__ = $link_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="__PUBLIC__/Images/home/online.png"><a href="<?php echo ($vo['addr']); ?>"><?php echo ($vo['info']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>

			
		<!-- footer-columns ends -->
		</div>	
		
		<div id="footer-bottom">		
			
			<p>
			&copy; 2012 <strong>淮阴工学院</strong> 
   		</p>		
			
		</div>
		
<!-- footer ends-->
</div>

<!-- wrap ends here -->
</div>

</body>
</html>