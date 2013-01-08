<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <title></title>
<style type="text/css">
	ul{
		list-style-type:none;
		font-size:14px;
	}
	li a{
		font-size:14px;	
	}
</style>
 </HEAD>

 <BODY>
  <?php echo ($cn); ?>
  <ul>
        <?php if(is_array($film_list)): $i = 0; $__LIST__ = $film_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__URL__/show_video/title/<?php echo ($vo['title']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>

 </BODY>
</HTML>