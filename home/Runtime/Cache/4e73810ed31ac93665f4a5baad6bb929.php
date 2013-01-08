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
   <form action="__URL__/<?php echo ($btn_ok_act); ?>"  method="post">
        标题:<input type="text" name="title" value="<?php echo ($work_item["title"]); ?>" />
        班级:<select name="select" id="selType">
                <?php if(is_array($class_name)): $i = 0; $__LIST__ = $class_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mm): $mod = ($i % 2 );++$i;?><option value="<?php echo ($mm['classname']); ?>"><?php echo ($mm['classname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
       </select>
        
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
        <br />
        截止时间：<input type="text" name="datehm" onclick="SelectDate(this,'yyyy-MM-dd',0,-150)" value="<?php echo ($work_item["time"]); ?>" readonly="true" style="width:265px;cursor:pointer"/><br />
        
        <input type="hidden" value="<?php echo ($work_item["id"]); ?>" name="id"/>
        <input type="submit" value="<?php echo ($btn_ok_text); ?>"/>
	</form>
</body>
</html>