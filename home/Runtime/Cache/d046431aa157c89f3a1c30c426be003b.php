<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta content="text/html; CHARSET=utf-8" http-equiv="Content-Type">	
<link rel="stylesheet" href="__PUBLIC__/Css/home/Outdoor.css" type="text/css" />

<title><?php echo ($title); ?></title>
<style type="text/css">
#tongzhi{
	border:1px solid #036;
	}
#mq{
	height:300px;
	margin-top:5px;
	margin-left:5px;
	margin-right:5px;
	}

</style>

</head>
<body>

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
       		<li id="current"><a href="#">首页</a></li>
        	<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="#"><?php echo ($vo['f_cata']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	<!-- navigation ends-->	
	</div>					
			
	<!-- content-wrap starts -->
	<div id="content-wrap">
				
		<div id="main">
				
			<a name="TemplateInfo"></a>
			<h2><a href="#">通知</a></h2>
			<div id="tongzhi">
            <marquee id="mq" direction="up" onMouseOver="this.stop()" onMouseMove="this.start()">
            <?php if(is_array($tongzhi_list)): $i = 0; $__LIST__ = $tongzhi_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><p><?php echo ($vo1['title']); ?> 作者：<?php echo ($vo1['name']); ?> 时间：<?php echo ($vo1['dt']); ?> </p>
                <hr />
                <p><?php echo ($vo1['content']); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
            </marquee>
            
            </div>
			

		<!-- main ends -->	
		</div>
		
		<div id="sidebar">
			
			<h3>用户登陆</h3>	
			<form action="__URL__/login" class="searchform" method="post">
            <table class="lo">
            	<tr>
                	<td width="70">用户名:</td>
                    <td><input name="username" class="textbox" type="text" /></td>
                </tr>
                <tr>
                	<td>密码:</td>
                    <td><input name="password" class="textbox" type="password" /></td>
                </tr>
                <tr>
                	<td colspan="2">
                    	<input name="login" class="button" value="登陆" type="submit" /><a href="__URL__/index_pwd">忘记密码？</a><a href="__URL__/index_regist">注册</a>
                    </td>
            
                </tr>	
            </table>
			</form>	
						
		<!-- sidebar ends -->		
		</div>
		
	<!-- content-wrap ends-->	
	</div>
		
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
			&copy; 1012 <strong>淮阴工学院</strong> 
   		</p>		
			
		</div>
		
<!-- footer ends-->
</div>

<!-- wrap ends here -->
</div>

</body>
</html>