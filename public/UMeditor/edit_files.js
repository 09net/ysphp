var upi;
 function insertfiles(a,name,ext,file_path) { 
if(ext=='jpg' || ext=='png' || ext=='gif'|| ext=='webp'){
$('#editor').append('<img src="'+file_path+'">');
 return '';
}

  if(ext=='mp3' || ext=='mp4'){
  $('#vs').val(file_path); 
  $('#upload').append('<video width="300" height="140" src="'+file_path+'" controls="controls" preload="none"></video>');  
 }
 
 $('#upload').append('<p>附件:'+name+'</p>');
 if($('#files').val()==''){
 $('#files').val(a);
}else{ $('#files').val($('#files').val()+','+a);}

}
 
 function edit_app_text(a){
 $('#editor').append('<span class="label label-primary">@'+a+'</span><p>&nbsp;</p>');
}

 var jdt = null;
 window.hy_edit_upload = false;
upvi=0;
upmp4i=0;
 function mp4up(type,id) {
if(upmp4i>0){
 swal("最多上传1个视频");
 return;
}
 upmp4i=1;
  
 var file = document.getElementById(id).files[0];
 if (file) {
 uploadFile(type,id);
}
}



 function fileSelected(type,id) {
 var file = document.getElementById(id).files[0];
 if (file) {
 uploadFile(type,id);
 
}
}

 function uploadFile(type,id) {
 if(window.hy_edit_upload){
 swal("请等待第一个上传完成!");
 return;
}
 
  if(upvi>4){
 swal("最多上传五个附件!");
 return;
}  
  upvi=upvi+1;
 window.hy_edit_upload = true;
 if(jdt != null){
 jdt.remove();
 jdt =null;
}
 jdt = $('<div class="progress progress-success" id="progressNumber"><div id="jdt" style="width:0%"></div></div>');
 $("#upload").append(jdt);
 var fd = new FormData();
 fd.append("photo", document.getElementById(id).files[0]);
 var xhr = new XMLHttpRequest();
 xhr.upload.addEventListener("progress", uploadProgress, false);
 xhr.addEventListener("load", uploadComplete, false);
 xhr.addEventListener("error", uploadFailed, false);
 xhr.addEventListener("abort", uploadCanceled, false);
 xhr.open("POST", www+'post'+exp+type);
 xhr.send(fd);
 document.getElementById(id).value = '';
}

 function uploadProgress(evt) {
 if (evt.lengthComputable) {
 var percentComplete = Math.round(evt.loaded * 100 / evt.total);
 $("#jdt").css('width',percentComplete.toString()+ '%') ;
}
 else {
 document.getElementById('progressNumber').innerHTML = 'unable to compute';
}
}
function uploadComplete(evt) {
 window.hy_edit_upload = false;
 var json = eval("("+evt.target.response+")");
 if(json.success){insertfiles(json.id,json.name,json.ext,json.file_path);}else{swal('Error',json.info,'error');} 
 jdt.remove();
}

 function uploadFailed(evt) {
 window.hy_edit_upload = false;
 swal('Error','上传失败','error');
}
 function uploadCanceled(evt) {
 window.hy_edit_upload = false;
 swal('Error','上传被中断,浏览器丢失上传链接,上传线路不稳定!','error');
}
