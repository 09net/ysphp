{include h}
<div class="container">
<div class="wrap-box">
<ol><li><a href="/">{lag 首页}</a></li><li class="fa fa-chevron-right">{lag 修改}</li></ol>
</div>
<div class="wrap-box">
<div class="row">
<div class="col-xs-12">
<input type="text" id="title" class="input-text" value="{$thread_data['title']}" placeholder="{lag 请填写标题}">
</div></div>
<label>{lag 内容} <span></span></label>
<script id="container" name="content" type="text/plain">{$data}</script>
<div class="wrap-box" style="margin-top:10px" id="upload">
<label for="fileTofUpload" class="btn btn-primary" ><i class="am-icon-check"></i>{lag 附件}(50M,rar,zip,mp3,mp4)</label>
<label for="mp4up" class="btn btn-primary" ><i class="am-icon-check"></i>{lag 视频}(50M,mp3,mp4)</label>
<input type="file" name="mp4up" id="mp4up" accept="audio/mp4,video/mp4,audio/mpeg" onChange="mp4up('uploadfiles','mp4up');" style="display: none;">
<input name="vs" id="vs" type="hidden" value="" />
<input type="file" name="fileTofUpload" id="fileTofUpload" onChange="fileSelected('uploadfiles','fileTofUpload');" style="display: none;">
<input name="files" id="files" type="hidden" value="" />
</div>

<button type="button" class="btn btn-primary" id="post1">{lag 发表}</button>
<link href="{#icdn}public/UMeditor/public/themes/default/css/umeditor.min.css" type="text/css" rel="stylesheet">
<link href="{#icdn}public/UMeditor/style.css" type="text/css" rel="stylesheet">
<script src="{#icdn}public/UMeditor/public/third-party/template.min.js"></script>
<script src="{#icdn}public/UMeditor/public/umeditor.min.js"></script>
<script src="{#icdn}public/UMeditor/public/umeditor.config.js"></script>
<!-- 实例化编辑器 -->
<script src="{#icdn}public/UMeditor/edit_files.js"></script>
<script>
 var ue = UM.getEditor('container',
 {
 imageFieldName:'photo',
 initialFrameWidth:"100%",
 imageUrl: "/post/upload",
 imagePath:'',
 initialFrameHeight:300,
   toolbar: ['source | insertimage insertcode undo redo | bold  | removeformat |', 'insertorderedlist insertunorderedlist | selectall paragraph | fontfamily fontsize' ,'| justifyleft justifycenter justifyright justifyjustify |', 'link unlink | image','| preview print fullscreen hide drafts'],
 zIndex:9000,
 }

 );

 
 function postzhen(_obj){
 _obj.text("{lag 提交中}");
 ue.execCommand('selectall');
 ue.execCommand('removeformat');
var getContent= formatImg(ue.getContent());
 var fid = $("#fid").val();
 if(fid<0){
  _obj.removeAttr('disabled');
 _obj.text("{lag 发表}");
 swal("error", "{lag 小组为空}", "error");
 
 }

 $.ajax({
 url: '/post/edit/{$thread_data['id']}.html',
 type:"POST",
 cache: false,
 data:{
 title:$("#title").val(),
 content:getContent,
 fid:fid,
 vs:$("#vs").val(),
 files:$("#files").val()
 },
 dataType: 'json'
 }).then(function(e) { 
 if(e.code==200){ 
 window.location.href="/t/"+e.id + ".html";
 
 }else{
 _obj.removeAttr('disabled');
 _obj.text("{lag 发表}");
 swal(e.error?"{lag 成功}":"{lag 失败}", e.info, e.error?"success": "error");
 }
 }, function() {
 _obj.removeAttr('disabled');
 _obj.text("{lag 发表}");
 swal("{lag 失败}", "{lag 请重新提交}", "error");
 });
 }
 
 
 
$(function(){
 $("#post1").click(function(){
 var _obj = $(this);
 _obj.attr('disabled','disabled');
 swal('{lag 上传图片}')
 setTimeout(uppase(_obj,'container'),500)
 })
})
</script></div></div>
<div id="footer"><span class="beian" style="margin-left:0">Runtime:<?php echo number_format(microtime(1) - $GLOBALS['START_TIME'], 4); ?>s</span><span class="beian" style="margin-left:0">Mem:<?php echo round((memory_get_usage() - $GLOBALS['START_MEMORY'])/1024); ?>Kb</span> </div>