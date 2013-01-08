<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	#basic_info{
		margin-top:20px;
	}
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
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_all.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_config.js"></script>
</head>
<body>
	<div id="basic_info">
    	<table class="msg_lis">
        	<tr>
            	<td>发件人:</td><td><?php echo ($msg_list["from_name"]); ?></td>
            </tr>
            <tr>
            	<td>内容:</td><td><?php echo ($msg_list["content"]); ?></td>
            </tr>
            <tr>
            	<td>时间:</td><td><?php echo ($msg_list["time"]); ?></td>
            </tr>
            <tr>
            	<td></td><td><input type="button" id="show" value="回复" /></td>
            </tr>
        </table>
        <div id="repeat">
        	<form action="__URL__/repeat/id/<?php echo ($msg_list["id"]); ?>" method="post">
            	<p>内容:</p>
            	<div id="myEditor">
		            <script type="text/javascript">
		                var editor = new baidu.editor.ui.Editor({
		                    minFrameHeight: 120,//初始化框架大小
		                    toolbars:[["bold","italic","undo","redo","indent","attachment","snapscreen","time","date","emotion"]],
		                    initialContent: '<?php echo ($msg_list["repeat"]); ?>'
		                });
		                editor.render("myEditor");
		            </script>
		    	</div>
    
                <input type="submit" name="submit" value="提交" />
            </form>
        </div>
    </div>
</body>