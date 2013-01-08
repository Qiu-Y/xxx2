<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	table.msg{
		font-size:13px;
		text-align:center;
			
	}
</style>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/ajaxupload.js"></script>

<script type="text/javascript">
	$(function(){
		
	});
</script>
</head>
<body>
	<div id="basic_info">
    	<table class="msg" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
        	<thead>
              <tr>
                <th width="100">发送人</th>
                <th width="200">消息内容</th>
                <th>时间</th>
                <th width="50">回复</th>
                <th width="50">操作</th>
              </tr>
            </thead>
            <tbody>
			  <?php if(is_array($msg_list)): $i = 0; $__LIST__ = $msg_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo['from_name']); ?></td>
                    <td><div id="aa"><a href="__URL__/msg_list/id/<?php echo ($vo['id']); ?>"><?php echo ($vo['content']); ?></a></div></td>
                    <td><?php echo ($vo['time']); ?></td>
                    <td><?php echo ($vo['repeat']); ?></td>
                    
                   
                    <td>
                       <a href="__URL__/delete_class/id/<?php echo ($vo['id']); ?>" title="删除"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a> 
                    </td>
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