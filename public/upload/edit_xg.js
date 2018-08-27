var upi;  
    function insertImg(img) {
        if(!document.execCommand('InsertImage', false, img))
			$("#img").attr('src',img+'_180'); 
			$('#imgv').val(img);
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
            swal("请等待第一个上传完成!");
            return;
        }
		if (type!="uploadfile"){
		  upi++;
		  if(upi>500){
            swal("最多可以上传5个文件");
            return;
        }
		}else{
		if(window.upvi){
            swal("只允许上传一个视频!");
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
          $("#jdt").css('width',percentComplete.toString()+ '%')  ;
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

                insertImg(json.file_path);
                
            }
            else{
                swal('Error',json.msg,'error');
            }

            
        }
             if(json.hasOwnProperty("info") ){
           if(json.success){
                insertvideo(json.name);
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
        swal('Error','上传失败','error');
        
      }

      function uploadCanceled(evt) {
        //document.getElementById("fileToUpload").value = '';
        //document.getElementById("fileToUpload1").value = '';
        window.hy_edit_upload = false;
        swal('Error','上传被中断,浏览器丢失上传链接,上传线路不稳定!','error');
        
      }
