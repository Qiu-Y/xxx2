<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/Js/calendar1.js"></script>

<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_all.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_config.js"></script>


<style type="text/css">
	body{
		font-size:14px;	
	}
</style>
<script type="text/javascript">
function getVal(){
		var i=0;
		var second=$("#second");
		$("option",second).remove();
		$.getJSON("__URL__/select",{name:$("#first").val()},function(json,status){
			if(!json)
			{
				alert("不存在数据");
			}
			else{
				for(i=0;i<json.data.length;i++)
				{
					var option = "<option value='"+json.data[i].s_cata+"'>"+json.data[i].s_cata+"</option>";
                    second.append(option);
				}
				
			}
		});
	}
$().ready(function(){
		getVal();
		$("#first").change(function(){
			getVal();
		});
		
	});
</script> 


</head>

<body>
   <form action="__URL__/add_hand"  method="post" enctype="multipart/form-data" >
        题目：<?php echo ($worklist["title"]); ?><br />
        内容：<?php echo ($worklist["content"]); ?>
        <div id="myEditor">
            <script type="text/javascript">
                var editor = new baidu.editor.ui.Editor({
                    minFrameHeight: 120,//初始化框架大小
                    toolbars:[["bold","italic","undo","redo","indent","attachment"]],
                    initialContent: '<?php echo ($work_item["content"]); ?>'
                });
                editor.render("myEditor");
            </script>
        </div>
        <input type="file" name="img" />
        <br></br>
        <input type="hidden" name="id" value="<?php echo ($worklist["id"]); ?>" />
        <input type="submit" value="提交"/>
	</form>
</body>
</html>