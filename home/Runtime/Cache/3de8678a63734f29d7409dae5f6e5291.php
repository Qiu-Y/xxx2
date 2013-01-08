<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_all.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_config.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.blockUI.js"></script>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
<style type="text/css">
	body{
		font-size:13px;
	}
	ul{
		list-style-type:none;
	}
	#content{
		margin-top:30px;
	}
	#subperson{
		display:block;
	}
	.cls:hover{
		cursor:pointer;
	}
</style>

<script type="text/javascript">
$(function(){
	$("#sure").click(function(){
		var oidStr='';
		$("#subperson input:checked").each(function(i,a){
		    oidStr +=a.value+',';  //拼接字符串
		  });
		$("#report").val(oidStr);
	});
	$(".choose").click(function(){
		$title=this.title;
		$title_array=$title.split(',');
		
		$.blockUI({    //当点击事件发生时调用弹出层
             message:$(".name"),    //要弹出的元素box

             css: {    //弹出元素的CSS属性
                 top: '30%',
				 left: '60%',
				 textAlign: 'left',
				 marginLeft: '-320px',
				 marginTop: '-145px',
                 background: 'white',
                 height:'400px',
                 overflow:'scroll',
                 cursor:'default'
            }
        });
		
		$('.blockOverlay').attr('title','单击关闭').click($.unblockUI);   //遮罩层属性的设置以及当鼠标单击遮罩层可以关闭弹出层
		});
	//$('.blockOverlay').attr('title','单击关闭').click($.unblockUI);   //遮罩层属性的设置以及当鼠标单击遮罩层可以关闭弹出层
	//$('#sure').click($.unblockUI);  //也可以自定义一个关闭按钮来关闭弹出层
	});
	function check(a){
		var por=$(a).text();
		if($('.'+por).css('display')=='block'){
			$('.'+por).css('display','none');
		}
		else{
			$('.'+por).css('display','block');
		}
	}
	function choose(a){
		var por=$(a).val();
		$('input[class="'+por+'"]').attr('checked',a.checked);
	}
	
</script>
<title>回复</title>
</head>
<body>
	
	<div id="content">
		<form action="__URL__/reportmsg"  method="post">
			<p>发送人：<input type="button" value="选择好友" class="choose" /></p>
			<div id="sender" class="name" style="display:none;">
				<input type="button" id="sure" value="确定">
				<ul id="main">
					<?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><input type="checkbox" value="<?php echo ($vo['classname']); ?>" onclick="choose(this)" /><span id="<?php echo ($vo['classname']); ?>" class="cls" onclick="check(this)"><?php echo ($vo['classname']); ?></span></li>
						<ul class="<?php echo ($vo['classname']); ?>" id="subperson" style="display:none">
							<?php if(is_array($person)): $i = 0; $__LIST__ = $person;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i; if(($sub["clas"]) == $vo["classname"]): ?><li><input type="checkbox" value="<?php echo ($sub['name']); ?>" class="<?php echo ($vo['classname']); ?>" name="name"/><?php echo ($sub['name']); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<textarea name="total_name" id="report" wrap="virtual" style="width:80%; background:#fff;"></textarea>
			<div id="myEditor">
		            <script type="text/javascript">
		                var editor = new baidu.editor.ui.Editor({
		                    minFrameHeight: 120,//初始化框架大小
		                    toolbars:[["bold","italic","undo","redo","indent","attachment","snapscreen","time","date","emotion"]],
		                    initialContent: '<?php echo ($work_item["content"]); ?>'
		                });
		                editor.render("myEditor");
		            </script>
		    </div>
		    <input type="submit" name="submit" value="发送"/>
	    </form>
	</div>
	<br />

</body>
</html>