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
<link rel="stylesheet" href="__PUBLIC__/ueditor/themes/default/ueditor.css"/>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_all.js"></script>
<script type="text/javascript" charset='gbk' src="__PUBLIC__/ueditor/editor_config.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script>
 </HEAD>

 <BODY>
 <div id="detail_body">
<?php if(is_array($content_list)): $i = 0; $__LIST__ = $content_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><p class="head"><?php echo ($vo1['title']); ?> <span>作者：<?php echo ($vo1['user']); ?>时间：<?php echo ($vo1['dt']); ?> </span></p>

	<p><?php echo ($vo1['content']); ?></p>
	<hr /><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div>
评论：<br/>

</div>
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

 </BODY>
</HTML>