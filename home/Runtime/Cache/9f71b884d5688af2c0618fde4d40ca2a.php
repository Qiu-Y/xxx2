<?php if (!defined('THINK_PATH')) exit();?><head>
<style type="text/css">
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
                <td width="180"><?php echo ($basic_info["name"]); ?></td>
                <td>上传照片</td>
             </tr>
             <tr>
                <td class="kk">学号:</td>
                <td><?php echo ($basic_info["num"]); ?></td>
                <td rowspan="3"><input type="hidden" name="picture" id="picture" value=""><input type="button" class="btn btn1" value="上传" id="upload_button"></td>
             </tr>
             <tr>
                <td class="kk">班级:</td>
                <td><?php echo ($basic_info["clas"]); ?></td>
             </tr>
             <tr>
             	<td class="kk">性别:</td>
                <td><?php echo ($basic_info["sex"]); ?></td>
              </tr>
              <tr>
                <td class="kk">qq:</td>
                <td><input name="qq" class="textbox" type="text" value="<?php echo ($basic_info["qq"]); ?>" /></td>
                <td><input type="file" name="img" /></td>
              </tr>
              
              <tr>
                <td class="kk">邮箱:</td>
                <td><input name="mail" class="textbox" type="text" value="<?php echo ($basic_info["mails"]); ?>" /></td>
                <td></td>
              </tr>
              <tr>
                <td class="kk">手机号码:</td>
                <td><input name="phone" class="textbox" type="text" value="<?php echo ($basic_info["phone"]); ?>" /></td>
                <td></td>
              </tr>
              <tr>
                <td class="kk">地址:</td>
                <td><input name="addr" class="textbox" type="text" value="<?php echo ($basic_info["addr"]); ?>"/></td>
                <td></td>
              </tr>
              <tr class="re">
  				<td colspan="3" style="text-indent:70px;"><input name="update" class="button" value="更改" type="submit" />
              </tr>
             </table>
			</form>	
    </div>
</body>