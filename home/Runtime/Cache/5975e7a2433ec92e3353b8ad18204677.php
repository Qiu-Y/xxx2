<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta content="text/html; CHARSET=utf-8" http-equiv="Content-Type">	
<link rel="stylesheet" href="__PUBLIC__/Css/home/Outdoor1.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/Css/home/room.css" type="text/css" />
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
</head>
<body>	

<!-- wrap starts here -->
<div id="wrap">

	<div id="ro_head"></div>
    <div id="ro_content">
    	<div id="ro_left">
        	<div id="p_img">
            	<img src="__ROOT__<?php echo ($link); ?>" width="125" height="150" />
            </div>
            <div id="list">
            	<ul>
                	<li><a href="__URL__/basic_info/" target="ifr">设置信息</a></li>
                    <li><a href="__URL__/head_img/" target="ifr">头像上传</a></li>
                    <li><a href="__URL__/short_msg/" target="ifr">短消息</a></li>
                    <li><a href="__URL__/change_pwd/"  target="ifr">修改秘密</a></li>
                </ul>
            </div>
            <div id="list2">
            	<ul>
                	<li><a href="__URL__/classlist/"  target="ifr">导入学生</a></li>
                	<li><a href="#">批改作业</a></li>
                    <li><a href="__URL__/worklist/"  target="ifr">布置作业</a></li>
                   
                </ul>
            </div>
        </div>
        	<iframe id="ifr" name="ifr" src="__URL__/basic_info" frameborder="0" scrolling="no" width="100%" onLoad="javascript:dyniframesize('ifr');"></iframe>
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
						
						///
						
						pTar.height = pTar.contentDocument.body.offsetHeight +20; 
						if(pTar.height<600)
						{
							pTar.height=600;
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
    
    </div>
</div>
<div id="footer-bottom">		
			
			<p>
			&copy; 2012 <strong>淮阴工学院</strong> 
   		</p>	
			
</div>
<!-- wrap ends here -->
</div>

</body>
</html>