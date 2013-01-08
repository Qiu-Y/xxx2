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
                <th width="100">作业题目</th>
                <th width="200">是否上交</th>
                <th width="200">截止时间</th>
                <th>等级</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			  <?php if(is_array($work_list)): $i = 0; $__LIST__ = $work_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><a href="__URL__/w_list/"><?php echo ($vo['id']); echo ($vo['title']); ?></a></td>
                    <td><div id="aa"><a href="__URL__/msg_list/id/<?php echo ($vo['id']); ?>"><?php echo ($vo['content']); ?></a></div></td>
                    <td><?php echo ($vo['time']); ?></td>
                    <td><?php echo ($vo['grade']); ?></td>
                    <td>
                    <?php
 $temp=0; if($workroute_list=='') { ?>
                                <a href="__URL__/handout/id/<?php echo ($vo['id']); ?>" title="上交">提交</a> 
                            <?php
 } else { foreach($workroute_list as $key) { if($key[home_id]==$vo['id']) { $temp=1; break; } } if($temp==0) { ?>
                                    <a href="__URL__/handout/id/<?php echo ($vo['id']); ?>" title="上交">提交</a> 
                                <?php
 } else{ ?>
                                    已交
                                <?php
 } } ?>
                  
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