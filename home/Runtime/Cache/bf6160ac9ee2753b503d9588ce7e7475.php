<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" href="__PUBLIC__/Css/admin/classroom.css" type="text/css" media="screen" />
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<style type="text/css">
body{
	padding-top:20px;
	font-size:14px;
}
</style>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
</head>
<body>
    
	<form enctype="multipart/form-data" method="post" action="__URL__/upxls">
        <p><strong>基本信息</strong><br /></p>
        <p><span>班级:</span><input type="text" name="classname" value="<?php echo ($classdata["classname"]); ?>" /></p>
		<p><span>班主任:</span><?php echo ($classdata["teacher"]); ?><br /></p>
        <p><span>人数限定</span>:
        <?php
 if($classdata['amount']==0) { ?>
                		无
                <?php
 } else{ ?>
                <?php echo ($classdata["amount"]); ?>
                <?php
 } ?>
        <br/>
		载入学生:<input type="hidden" name="MAX_FILE_SIZE" value="30000" /><br/>
      	<input type="file" name="filename" id="add" accept="*.xls" value="浏览" />
      	<br />
      	<input type="submit" name="submit" value="提交" />
    </form>
</body>
<!-- Download From www.exet.tk-->
</html>