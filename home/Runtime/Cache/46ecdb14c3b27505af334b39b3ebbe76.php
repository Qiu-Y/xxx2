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
<link rel="stylesheet" href="__PUBLIC__/Css/home/sroom.css"/>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>

<script type="text/javascript">
	$(function(){
		
	});
</script>
</head>
<body>
	<div style="padding:15px 0;color:#000; margin-top:30px;">
  上传一张真人照片
  </div>
  <form enctype="multipart/form-data" method="post" name="upform" target="upload_target"  action="__APP__/Sroom/upload">
  <input type="file" name="Filedata" id="Filedata" class="btn"/>
  <input style="margin-right:20px;" type="submit" name="" value="上传形象照" class="btn" onclick="return checkFile();" /><span style="visibility:hidden;" id="loading_gif"><img src="/loading.gif" align="absmiddle" />上传中，请稍侯......</span>
  </form>
  <iframe src="about:blank" name="upload_target" style="display:none;"></iframe>
  <div id="avatar_editor"></div>
  <script type="text/javascript">
  //允许上传的图片类型
  var extensions = 'jpg,jpeg,gif,png';
  //保存缩略图的地址.
  var saveUrl = '/xxx2/index.php/Sroom/save';
  //var saveUrl = '/xxx2/public/avatar/save_avatar.php';
  //保存摄象头白摄图片的地址.
  var cameraPostUrl = '/xxx2/index.php/Sroom/camera';
  //头像编辑器flash的地址.
  var editorFlaPath = '/xxx2/public/avatar/AvatarEditor.swf';
  function useCamera()
  {
   var content = '<embed height="464" width="514" ';
   content +='flashvars="type=camera';
   content +='&postUrl='+cameraPostUrl+'?&radom=1';
   content += '&saveUrl='+saveUrl+'?radom=1" ';
   content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
   content +='allowscriptaccess="always" quality="high" ';
   content +='src="'+editorFlaPath+'"/>';
   document.getElementById('avatar_editor').innerHTML = content;
  }
  function buildAvatarEditor(pic_id,pic_path,post_type)
  {
   var content = '<embed height="464" width="514"'; 
   content+='flashvars="type='+post_type;
   content+='&photoUrl='+pic_path;
   content+='&photoId='+pic_id;
   content+='&postUrl='+cameraPostUrl+'?&radom=1';
   content+='&saveUrl='+saveUrl+'?radom=1"';
   content+=' pluginspage="http://www.macromedia.com/go/getflashplayer"';
   content+=' type="application/x-shockwave-flash"';
   content+=' allowscriptaccess="always" quality="high" src="'+editorFlaPath+'"/>';
   document.getElementById('avatar_editor').innerHTML = content;
  }
   /**
     * 提供给FLASH的接口 ： 没有摄像头时的回调方法
     */
    function noCamera(){
     alert("俺是小狗, 俺没有camare ：");
    }
     
   /**
    * 提供给FLASH的接口：编辑头像保存成功后的回调方法
    */
   function avatarSaved(){
	   
	    alert('保存成功，哈哈');
	    
		window.location.href = '/xxx2/index.php/Sroom/basic_info';
    //window.location.href = '/profile.do';
   }
   
    /**
     * 提供给FLASH的接口：编辑头像保存失败的回调方法, msg 是失败信息，可以不返回给用户, 仅作调试使用.
     */
    function avatarError(msg){
    	alert("aa上传失败了呀，哈哈");
    }

    function checkFile()
    {
     var path = document.getElementById('Filedata').value;
     var ext = getExt(path);
     var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
      if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
     alert('对不起，只能上传jpg, gif, png类型的图片');
     return false;
     }
     showLoading();
     return true;
    }

    function getExt(path) {
    return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
   }
     function showLoading()
     {
      document.getElementById('loading_gif').style.visibility = 'visible';
     }
     function hideLoading()
     {
    document.getElementById('loading_gif').style.visibility = 'hidden';
     }
  </script>
 </div>
</body>