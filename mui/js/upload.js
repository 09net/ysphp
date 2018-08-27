var upi;
 function insertvideo(a,name,id) { 
 window.upvi=true;
 $('#img').append('<p><video width="300" height="140" src="'+a+'" controls="controls"></video></p>')
			$('#vidv').val($('#vidv').val()+','+a);
			
$('#img').append('<p>附件:'+name+'</p>');
 if($('#files').val()==''){
 $('#files').val(id);
}else{ $('#files').val($('#files').val()+','+id);}

			
			
}
 function insertImg(img,w,h) {
 if(!document.execCommand('InsertImage', false, img))
 $('#img').append('<img src="'+img+'_180">');
 $('#imgv').val($('#imgv').val()+','+img+'@'+w+'|'+h);
}
 function edit_app_text(a){
 $('#editor').append('<span class="label label-primary">@'+a+'</span><p>&nbsp;</p>');
}

 var jdt = null;
 window.hy_edit_upload = false;
	window.upvi= false;
 function fileSelected(type,id) {
 var file = document.getElementById(id).files[0];
 if (file) {
 uploadFile(type,id);
 
}
}

 function uploadFile(type,id) {
 if(window.hy_edit_upload){
 mui.alert("...");
 return;
}
if (type!="uploadfiles"){
upi++;
if(upi>5){
 mui.alert(l[lang]['附件']+">5");
 return;
}
		}else{
		if(window.upvi){
 mui.alert(l[lang]['视频']+">1");
 return;
}	
		}
		
		
		
 window.hy_edit_upload = true;
 if(jdt != null){
 jdt.remove();
 jdt =null;
}
 jdt = $('<div class="progress progress-success" id="progressNumber"><div id="jdt" style="width:0%"></div></div>');
 $("#upload").append(jdt);
 var fd = new FormData();
 fd.append("photo", document.getElementById(id).files[0]);
		fd.append("YSV8_HEX", ysv8hex);
 var xhr = new XMLHttpRequest();
 xhr.upload.addEventListener("progress", uploadProgress, false);
 xhr.addEventListener("load", uploadComplete, false);
 xhr.addEventListener("error", uploadFailed, false);
 xhr.addEventListener("abort", uploadCanceled, false);
 xhr.open("POST", www+'post/'+type+'.api');
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
 //document.getElementById("fileToUpload").value = '';
 //document.getElementById("fileToUpload1").value = '';
 var json = eval("("+evt.target.response+")");
 if(json.hasOwnProperty("msg") ){
 if(json.success){

insertImg(json.file_path,json.w,json.h); 
 
}else{
 swal('Error',json.msg,'error');
}

 
}
 if(json.hasOwnProperty("info") ){
 if(json.success){
 insertvideo(json.file_path,json.name,json.id);
}
 else{
 swal('Error',json.info,'error');
} 
} 
 jdt.remove();
}

 function uploadFailed(evt) {
 //document.getElementById("fileToUpload").value = '';
 //document.getElementById("fileToUpload1").value = '';
 window.hy_edit_upload = false;
 swal('Error',l[lang]['失败'],'error');
 
}

 function uploadCanceled(evt) {
 //document.getElementById("fileToUpload").value = '';
 //document.getElementById("fileToUpload1").value = '';
 window.hy_edit_upload = false;
 swal('Error',l[lang]['失败'],'error');
 
}
