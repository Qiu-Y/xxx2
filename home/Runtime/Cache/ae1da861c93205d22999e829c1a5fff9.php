<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	table.msg{
		font-size:13px;
		text-align:center;
			
	}
</style>
<link rel="stylesheet" href="__PUBLIC__/Css/home/room.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/Css/home/show.css" type="text/css" />

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/ajaxupload.js"></script>

<script type="text/javascript">
	$(function(){
		
	});
</script>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
</head>
<body>
	<div style="margin-bottom:10px;">
    <a href="__URL__/addwork"><input type="button" value="添加" onClick="window.location.href('__URL__/addwork')" style="width:80px; height:60px;" /></a>
    </div>
	<div id="basic_info">
    	<table class="msg" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
        	<thead>
              <tr>
                <th width="100">题目</th>
                <th width="200">具体内容</th>
                <th width="100">截止时间</th>
                <th width="80">完成人数</th>
                <th width="80">未交人数</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			  <?php if(is_array($work_list)): $i = 0; $__LIST__ = $work_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><a href="__URL__/addwork/id/<?php echo ($vo['id']); ?>"><?php echo ($vo['title']); ?></a></td>
                    <td><div id="aa"><?php echo ($vo['content']); ?></div></td>
                    <td><?php echo ($vo['time']); ?></td>
                    <td>11</td>
                    <td>22</td> 
                    <td><a href="__URL__/delete/id/<?php echo ($vo['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
            <tfoot>
              <tr>
                <td colspan="6">
                  <div class="pagination">               	  
                  	<?php echo ($page_method); ?>
                  <!--
                  	<a href="#" title="First Page">&laquo; First</a>
                  	<a href="#" title="Previous Page">&laquo; Previous</a> 
                  	<a href="#" class="number" title="1">1</a> 
                  	<a href="#" class="number" title="2">2</a> 
                  	<a href="#" class="number current" title="3">3</a> 
                  	<a href="#" class="number" title="4">4</a> 
                  	<a href="#" title="Next Page">Next &raquo;</a>
                  	<a href="#" title="Last Page">Last &raquo;</a> 
                  -->
                  </div>                 
                  <div class="clear"></div>
                </td>
              </tr>
            </tfoot>
        </table>
    </div>
</body>