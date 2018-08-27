{include h}
{include header}
<section class="body">

<div class="ys-box ys-bo-b ys-bo-t" style="margin-top:10px">
{if isset($fdata)}<input id="fid" type="hidden" value="{$fdata['id']}" />{else}<select id="fid" type="text" class="input-text" style="width:150px;margin-bottom:10px"><option value="-1">{lag 选择}</option>{if $forum}
{foreach $forum as $key => $v}<option value="{$v['id']}">{$v['name']}</option>{/foreach}{/if}</select>{/if}
 <div class="ys-input-box">
 <input id="title" type="text" placeholder="{lag 请输入标题}">
 </div>
</div>

<div class="ys-box" style="font-size: 16px;">
<div id="editor" class="ys-editor" contenteditable="true">
<p></p>
</div>
 <div style="" id="upload">
<label for="fileimg" class="btn btn-danger" >{lag 图片}</label>
<label for="fileTofUpload" class="btn btn-danger" >{lag 附件}</label>
<label for="mp4up" class="btn btn-danger" >{lag 视频}(50M,mp3,mp4)</label>
<input type="file" name="mp4up" id="mp4up" onchange="mp4up('uploadfiles','mp4up');" style="display: none;">
<input name="vs" id="vs" type="hidden" value="" />
<input type="file" name="fileimg" id="fileimg" onchange="fileSelected('upload','fileimg');" style="display: none;">
<input type="file" name="fileTofUpload" id="fileTofUpload" onchange="fileSelected('uploadfiles','fileTofUpload');" style="display: none;">
<input name="files" id="files" type="hidden" value="" />
</div><p style="height:1px"></p>
</div>

<script src="{#icdn}public/UMeditor/edit_files.js"></script>
<div class="ys-box" style="padding:10px">
<button type="button" id="post1" class="btn btn-danger" >{lag 发布}</button>
</div>
<script>

function postzhen(_obj){
_obj.text("{lag 提交中}...");
 var fid = $("#fid").val();
 if(fid<0){
  _obj.removeAttr('disabled');
 _obj.text("{lag 发表}");
 swal("error", "{lag 栏目为空}", "error");
 
 }
 
 
 $.ajax({
 url: '/post.html',
 type:"POST",
 cache: false,
 data:{
title:$("#title").val(),
 content:$("#editor").html(),
 fid:fid,
 vs:$("#vs").val(),
 files:$("#files").val()
 },
 dataType: 'json'
 }).then(function(e) {
 
 if(e.code==200){ 
 window.location.href="/t/"+e.id + ".html";
 
 }else{
 $.ys.warning( e.info);
 }
 _obj.removeAttr('disabled');
 _obj.text("{lag 发布}");
 }, function() {
 $.hy.warning( "{lag 请尝试重新提交}");
 _obj.removeAttr('disabled');
 _obj.text("{lag 发布}");
 });
}
$(function(){ 
 $("#post1").click(function(){
var _obj = $(this);
 _obj.attr('disabled','disabled');
 swal('{lag 上传图片}')
 setTimeout(uppase(_obj,'editor'),500)
 })
});
</script>
</section>
<style type="text/css">
.body{
overflow: auto;-webkit-overflow-scrolling: touch;}
#editor{
padding:10px;border: thin solid #999999;min-height:100px;
}</style>

{include f}