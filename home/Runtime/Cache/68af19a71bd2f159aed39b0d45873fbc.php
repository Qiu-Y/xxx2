<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	table.msg{
		font-size:13px;
		text-align:center;
			
	}
</style>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
<link rel="stylesheet" href="__PUBLIC__/Css/home/room.css" type="text/css" />
<link rel="stylesheet" href="__PUBLIC__/Css/home/show.css" type="text/css" />

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/ajaxupload.js"></script>

<script type="text/javascript">
	$(function(){
		
	});
</script>
</head>
<body>
	<div style="margin-bottom:10px;">
    </div>
	<div id="basic_info">
    	<table class="msg" border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
        	<thead>
              <tr>
                <th width="100">班级</th>
                <th width="200">老师</th>
                <th width="80">限定人数</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
			  <?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo['classname']); ?></td>
                    <td><div id="aa"><?php echo ($vo['teacher']); ?></div></td>
                    <td><?php echo ($vo['amount']); ?></td>
                    <td>
                    <a href="__URL__/lead/id/<?php echo ($vo['id']); ?>" title="导入学生"><img src="__PUBLIC__/Images/admin/icons/add.gif" alt="导入学生" /></a>
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