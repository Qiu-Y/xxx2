<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<style type="text/css">
table{
	text-align:center;
}
</style>
</head>
<body>
	
	<div><input type="button" value="删除" /></div>
	<form action="__URL__/delete/sc" method="post">
		<table class="msg" border="0" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
	         <thead>
	           <tr>
	             <th width="100">操作</th>
	             <th width="200">学号</th>
	             <th width="100">姓名</th>
	             <th width="100">性别</th>
	             <th width="100">联系方式</th>
	             <th width="100">删除</th>
	           </tr>
	         </thead>
	         <tbody>
	           <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	                 <td><input type="checkbox" name="<?php echo ($vo['id']); ?>" /><?php echo ($vo['id']); ?></td>
	                 <td><?php echo ($vo['num']); ?></td>
	                 <td><?php echo ($vo['name']); ?></td>
	                 <td><?php echo ($vo['sex']); ?></td>
	                 <td><?php echo ($vo['phone']); ?></td>
	                 <td><a href="__URL__/delete/login/id/<?php echo ($vo['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> </td>
	               </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
	         </tbody>
	     </table>
     </form>
        
        
</body>
</html>