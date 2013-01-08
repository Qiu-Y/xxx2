<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
 </HEAD>
<style type="text/css">
	ul{
		list-style-type:none;
		font-size:14px;
	}
	li a{
		font-size:14px;	
	}
	
	body
	{
		font-size:13px;
		color:#666;
		background:#f2f0f1;
	}
</style>
 <BODY>
 <?php echo ($title); ?>
  <ul>
        <?php if(is_array($clog)): $i = 0; $__LIST__ = $clog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__URL__/de_videos/title/<?php echo ($vo['f_cata']); ?>"><?php echo ($vo['f_cata']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
 </BODY>
</HTML>