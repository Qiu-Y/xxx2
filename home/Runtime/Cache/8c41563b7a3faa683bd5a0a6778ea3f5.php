<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <title></title>
  <style type="text/css">
body
{
	font-size:13px;
	color:#666;
	background:#f2f0f1;
}
p.head{
	text-align:center;
	height:40px;
	line-height:40px;
	font-size:15px;
	font-weight:bold;
}
p.head span{
	font-size:13px;
	font-weight:normal;
	float:right;
	margin-right:20px;
}
</style>
 </HEAD>

 <BODY>
 <?php echo ($title); ?>
 <div id="detail_body">
<?php echo ($film_list["content"]); ?>

</div>

 </BODY>
</HTML>