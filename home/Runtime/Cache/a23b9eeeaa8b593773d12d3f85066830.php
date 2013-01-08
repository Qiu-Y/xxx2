<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	table.msg_lis{
		font-size:13px;
		text-align:left;
			
	}
	#repeat{
		width:600px;	
		height:400px;
		display:none;
	}
	#text_con
	{
		width:200px;
		height:160px;	
	}
	p{
		font-size:14px;
		font-weight:bold;	
	}
</style>

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#show").click(function(){
			$("#repeat").css("display","block");
			});
		
	});
</script>
</head>
<body>
	<div id="basic_info">
    	<table class="msg_lis">
            <?php if(is_array($msg_list)): $i = 0; $__LIST__ = $msg_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            	<td>发件人:</td><td><?php echo ($vo['from_name']); ?></td>
            </tr>
            <tr>
            	<td>内容:</td><td><?php echo ($vo['content']); ?></td>
            </tr>
            <tr>
            	<td>时间:</td><td><?php echo ($vo['time']); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
            
            	<td></td><td><input type="button" id="show" value="回复" /></td>
            </tr>
        </table>
        <div id="repeat">
        	<form action="__URL__/repeat/id/<?php echo ($vo['id']); ?>" method="post">
            	<p>内容:</p>
                <textarea name="content" id="text_con" ><?php echo ($vo['repeat']); ?></textarea><br />
                <input type="submit" name="submit" value="提交" />
            </form>
        </div>
    </div>
</body>