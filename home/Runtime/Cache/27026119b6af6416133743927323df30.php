<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	table.pwd{
		font-size:13px;
		
	}
</style>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
	$(function(){
		
		
	});
</script>
</head>
<body>
	<div id="basic_info">
    	<form action="__URL__/change_pwd/id/<?php echo ($username); ?>" method="post">
            <table class="pwd">
            	<tr>
                	<td>旧密码:</td>
                    <td><input type="password" name="old_pwd" /></td>
                </tr>
                <tr>
                	<td>新密码:</td>
                    <td><input type="password" name="pwd" /></td>
                </tr>
                <tr>
                	<td>再次输入新密码:</td>
                    <td><input type="password" name="re_pwd" /></td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" name="submit" value="提交" /></td>
                </tr>
            </table>
        </form>
    </div>
</body>