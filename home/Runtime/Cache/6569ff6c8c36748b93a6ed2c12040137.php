<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
	#basic_info{
		margin:40px 0px 0 60px;
	}
	table.aa{
		font-size:13px;
	}
	table.aa tr{
		height:30px;
	}
	table.aa td.kk{
		text-align:right;
	}
</style>
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/ajaxupload.js"></script>

<script type="text/javascript">
	$(function(){
		
	});
</script>
</head>
<body>
	<div id="basic_info">
    	<h3><img src="__PUBLIC__/Images/home/2.png" width="20" height="20" border="0">基本信息</h3>	
			<form action="__URL__/update" class="searchform" method="post"  enctype="multipart/form-data">
            <table class="aa" border="0">
             <tr>
				<td class="kk" width="80">用户名:</td>
                <td width="180"><?php echo ($basic_info["name"]); ?><input type="hidden" name="username" value="<?php echo ($basic_info["name"]); ?>" /></td>
             </tr>
             <tr>
                <td class="kk">班级:</td>
                <td>
                
                <?php
 if($teacher_class=="") { ?>
                        	暂无
                        <?php
 } else{ ?>
                        <?php if(is_array($teacher_class)): $i = 0; $__LIST__ = $teacher_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['classname']); endforeach; endif; else: echo "" ;endif; ?>
                        <?php
 } ?>
                
                </td>
             </tr>
              <tr>
                <td class="kk">qq:</td>
                <td><input name="qq" class="textbox" type="text" value="<?php echo ($basic_info["qq"]); ?>" /></td>
              </tr>
              
              <tr>
                <td class="kk">邮箱:</td>
                <td><input name="mail" class="textbox" type="text" value="<?php echo ($basic_info["e_mail"]); ?>" /></td>
              </tr>
              <tr>
                <td class="kk">手机号码:</td>
                <td><input name="phone" class="textbox" type="text" value="<?php echo ($basic_info["phone"]); ?>" /></td>
              </tr>
              <tr>
                <td class="kk">地址:</td>
                <td><input name="addr" class="textbox" type="text" value="<?php echo ($basic_info["addr"]); ?>"/></td>
              </tr>
              <tr class="re">
  				<td colspan="2" style="text-indent:70px;"><input name="update" class="button" value="更改" type="submit" />
              </tr>
             </table>
			</form>	
    </div>
</body>