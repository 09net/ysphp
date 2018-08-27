function mswal(json){
if(json.hasOwnProperty('gold')) $("#mygold").text(json['gold']);
if(json.hasOwnProperty('type')){swaltype=json['type'];}else{swaltype='warning';}
if(json['link']){
swal({
title: json.info,
type: swaltype,
showCancelButton: false,
confirmButtonColor: "#DD6B55",
confirmButtonText: langfun('确定')
},function(){
window.location.href = json['link'];
});
}else{swal({type: swaltype,title: json.info});}}
function zshang(uid,obj){
$.ajax({
url: '/open/shang',
type:"POST",
cache: false,
data:{uid:uid},
dataType: 'json'
}).then(function(e) {
mswal(e);
  $(obj).css("color","red");
  $(obj).css("background-color","#FFFFFF");
}, function() {
swal('error', langfun('失败'), "error");
});
}
function fav_jubao(obj,id){
	
swal({
title: langfun('删除'),text:'<select id="jubao" class="hy-text"><option value="0">'+langfun('选择')+'</option><option value="sexy">'+langfun('色情')+'</option><option value="rumor">'+langfun('谣言')+'</option><option value="bilk">'+langfun('诈骗')+'</option><option value="extreme">'+langfun('极端')+'</option><option value="no">'+langfun('失败')+'</option></select>',html: true,confirmButtonText: langfun('确定'),
cancelButtonText:langfun('取消'),showCancelButton: true,closeOnConfirm: false,animation: "slide-from-top"},
function(){
	inputValue=$('#jubao').val();
if(inputValue==0){swal('error',langfun('选择'),'error'); return false;}
$.ajax({
url: '/open/tc_fav',
type:"POST",
cache: false,
data:{fid:inputValue,nowurl:id,size:'favjubao'},
dataType: 'json'
}).then(function(data) {
 if(data.code==200){swal('success',data.info,'success');
return true;}else{swal('error',data.info,'error');}
},function() {swal('error');});
}); 	
	}
function jubao(){
swal({
title: langfun('删除'),text:'<select id="jubaoz" class="hy-text"><option value="0">'+langfun('选择')+'</option><option value="sexy">'+langfun('色情')+'</option><option value="rumor">'+langfun('谣言')+'</option><option value="bilk">'+langfun('诈骗')+'</option><option value="extreme">'+langfun('极端')+'</option><option value="no">'+langfun('失败')+'</option></select>',html: true,showCancelButton: true,confirmButtonText: langfun('确定'),
cancelButtonText:langfun('取消'),closeOnConfirm: false,animation: "slide-from-top"},
function(){
inputValue=$('#jubaoz').val();
if(inputValue==0){swal('error',langfun('选择'),'error'); return false;}
$.ajax({
url: www+'j/add',
type:"POST",
cache: false,
data:{content:inputValue,url:location.href},
dataType: 'json'
}).then(function(data) {
 if(data.code==200){swal('success',data.info,'success');
return true;}else{swal('error',data.info,'error');}
},function() {swal('error');});
}); 


}
var nowurl=document.location.href;
nowurl=nowurl.toLowerCase();
nownum=nowurl.indexOf('ysv8.com/');
if(nownum>0){nowurl=nowurl.substring(nownum+8);}
nownum=nowurl.indexOf('#');
if(nownum>0){nowurl=nowurl.substring(0,nownum);}
var nowtitle=document.title;
function get_tc_fav(title,url,obj){
swal({title: langfun('收藏'),text:'<select id="jubao5" class="hy-text"><option value="0">'+langfun('选择')+'</option><option value="2">'+langfun('图片')+'</option><option value="3">'+langfun('视频')+'</option><option value="4">'+langfun('文档')+'</option><option value="5">'+langfun('军事')+'</option><option value="6">'+langfun('社会')+'</option><option value="7">'+langfun('娱乐')+'</option><option value="8">'+langfun('搞笑')+'</option><option value="9">'+langfun('经济')+'</option><option value="10">'+langfun('政治')+'</option><option value="11">'+langfun('科技')+'</option><option value="12">'+langfun('体育')+'</option><option value="13">'+langfun('奇闻')+'</option><option value="14">'+langfun('情感')+'</option><option value="15">'+langfun('文化')+'</option><option value="16">'+langfun('家庭')+'</option><option value="17">'+langfun('两性')+'</option><option value="18">'+langfun('历史')+'</option></select>',html: true,showCancelButton: true,closeOnConfirm: false,confirmButtonText: langfun('确定'),
cancelButtonText:langfun('取消'),animation: "slide-from-top"},
function(){
inputValue=$('#jubao5').val();
if(inputValue==0){swal('error',langfun('选择'),'error'); return false;}
$.ajax({url: '/open/tc_fav',type:"POST",cache: false,data:{fid:inputValue,title:title,nowurl:url,size:'add'},
dataType: 'json'}).then(function(e) {

if(e['info']){
swal("error", e['info'], "error"); return 0;}
if(e['fsize']=='add'){
	$(obj).css("color","red");
  $(obj).css("background-color","#FFFFFF");
var news_sub={url:nowurl};my_tc_fav.push(news_sub);
}

swal('success',langfun('成功'),'success');
var str = JSON.stringify(my_tc_fav); 
localStorage.setItem("my_tc_fav",str);

}, function() {/*错误*/});
});
}
 
 /**/


var my_f_state=[];/*关注*/
var my_tc_fav=[];/*同城收藏*/
var optionss=localStorage.getItem("my_f_state"); 
if(optionss){my_f_state=JSON.parse(optionss);}
var optionss=localStorage.getItem("my_tc_fav"); 
if(optionss){my_tc_fav=JSON.parse(optionss);}
function tc_fav(myid,obj){
	if(islogin){
get_tc_fav(myid,obj);
	}else{
mswal({link:'/user/login',info:langfun('登录')});
		}
}

function f_friend(uid,obj){
 f_friend_state(uid,function(b,m){
 var _obj = $(obj);
 if(m){
 _obj.removeClass("bg-primary");
 _obj.addClass("bg-red");
 _obj.removeAttr('onclick');
 _obj.text(langfun('取消'));
 }
 else{
 _obj.removeClass("bg-red");
 _obj.addClass("bg-primary");
 _obj.removeAttr('onclick');
 _obj.text(langfun('关注'));
 }
 })
}

function f_friend_state(uid,callback){
$.ajax({
url: www+'forum/friend_state',
type:"POST",
cache: false,
data:{id:uid},
dataType: 'json'
}).then(function(e) {
if(e.info){mswal(e);} 
callback(e.error,e.id);
}, function() {
swal('error', langfun('失败'), "error");
});
}
function qiandao(){$.ajax({url: www+'open/qiandao',type:"get",cache: false,data:{},dataType: 'json'}).then(function(e) {
if(e.info) mswal(e);
}, function() {
swal('error', langfun('失败'), "error");
});}
function fav(id,url){ 
$.ajax({
url: '/'+url+'/fav',
type:"post",
xhrFields: {withCredentials: true}, 
crossDomain: true,
cache: false,
data:{id:id},
dataType: 'json'
}).then(function(e) {
setTimeout(swal(langfun('收藏'),e.info,'success'),500);
}, function() {
setTimeout(swal(langfun('错误'),langfun('未知错误'),'error'),500);
});
}
function langfun(str){
if (typeof(l[str]) != "undefined") return l[str];/*JS获取*/
var optionss=myStorage.getItem(lang+str); /*缓存获取*/
if(optionss) return optionss;
$.ajax({type : 'get',async : true, url : '/fy/'+encodeURIComponent(str)+'.html', cache : true,data : {},  success : function(data){myStorage.setItem(lang+str,data.info);}  });
return str;
}

function pl_pid(id){
	$("#pid").val(id);
	$("#acom").text('@'+id);
	
	try {
if(typeof open_post_box === "function") {
open_post_box();
} else {
$("html,body").animate({scrollTop:$("#content").offset().top-200},1);
}
            } catch(e) {}
}
function downloadFile(url){
    var form=$("<form>");//定义form表单,通过表单发送请求
    form.attr("style","display:none");//设置为不显示
    form.attr("target","");
    form.attr("method","get");//设置请求类型  
    form.attr("action",url);//设置请求路径
    $("body").append(form);//添加表单到页面(body)中
    form.submit();//表单提交
}
function downfile(id) {
    $.ajax({
        url: '/ajax/downfile?id='+ id,
        type: "GET",
        cache: false,
        dataType: 'json'
    }).then(function(e) {

        if (e.error) {
downloadFile(e['info']);
        } else {
		        swal("error",e['info'], "error");	
		}



    }, function() {
        swal("error", langfun('请重新提交'), "error");
    });
}
window.cookieStorage = (new (function(){var maxage = 60*60*24*1000; var path = '/'; var cookie = getCookie(); 
function getCookie(){ 
 var cookie = {}; 
 var all = document.cookie; 
 if(all === "") 
 return cookie; 
 var list = all.split("; "); 
 for(var i=0; i < list.length; i++){ 
 var cookies = list[i]; 
 var p = cookies.indexOf("="); 
 var name = cookies.substring(0,p); 
 var value = cookies.substring(p+1); 
 value = decodeURIComponent(value); 
 cookie[name] = value; 
 } 
 return cookie; 
 } 
 var keys = []; 
 for(var key in cookie) 
 keys.push(key); 
 this.length = keys.length; 
 this.key = function(n){ 
 if(n<0 || n >= keys.length) 
 return null; 
 return keys[n]; 
 }; 
 this.setItem = function(key, value){ 
 if(! (key in cookie)){ 
 keys.push(key); 
 this.length++; 
 } 
 cookie[key] = value; 
 var cookies = key + "=" +encodeURIComponent(value); 
 if(maxage) 
 cookies += "; max-age=" + maxage; 
 if(path) 
 cookies += "; path=" + path; 
 document.cookie = cookies; 
 }; 
 this.getItem = function(name){ 
 return cookie[name] || null; 
 }; 
 this.removeItem = function(key){ 
 if(!(key in cookie)) 
 return; 
 delete cookie[key]; 
 for(var i=0; i<keys.length; i++){ 
 if(keys[i] === key){ 
 keys.splice(i, 1); 
 break; 
 } 
 } 
 this.length--;
 document.cookie = key + "=; max-age=0"; 
 }; 
this.clear = function(){ 
for(var i=0; i<keys.length; i++) 
document.cookie = keys[i] + "; max-age=0"; 
cookie = {}; 
keys = []; 
this.length = 0; 
}; 
})()); 
window.myStorage = (new (function(){ 
var storage; 
if(window.localStorage){ storage = localStorage;}else{ storage = cookieStorage;} 
this.setItem = function(key, value){storage.setItem(key,value);}; 
this.getItem = function(name){return storage.getItem(name);}; 
this.removeItem = function(key){storage.removeItem(key);}; 
this.clear = function(){storage.clear();}; 
})());
function friend_ajax(myuid,obj){
	if(islogin){
get_f_s(myuid,obj);
	}else{
mswal({link:'/user/login',info:langfun('登录')});
		}
}



var my_f_state=[];/*关注*/
var optionss=myStorage.getItem("my_f_state"); 
if(optionss) my_f_state=JSON.parse(optionss);	
function vote(id,url,type){
	
$.ajax({url: '/'+url+'/vote',type:"post",cache: false,data:{id:id,type:type},
 dataType: 'json'}).then(function(e) {
if(e['code']!=200){swal("error", e['info'], "error");}else{
	swal('success',langfun('成功'),'success');
}
 });


	}
function set_top(id,url,type){
	
$.ajax({url: '/'+url+'/set_top',type:"post",cache: false,data:{id:id,type:type},
 dataType: 'json'}).then(function(e) {
if(e['error']){swal("error", e['info'], "error");}else{
	swal('success',langfun('成功'),'success');
}
 });
}	
	
	
function get_f_s(myuid,obj){
$.ajax({url: '/friend/friend_state',type:"post",cache: false,data:{uid:myuid},
 dataType: 'json'}).then(function(e) {
	 
if(myuid==0){myuid=uid;}else{
if(e['code']!=200){swal("error", e['info'], "error"); return 0;}
	swal('success',langfun('成功'),'success');
}

	if(e['id']){
var news_sub={uid2:myuid};
my_f_state.push(news_sub);	
		}else{
			
for (arr2i = 0;arr2i < my_f_state.length; arr2i++) {
if(myuid==myarr[arr2i]['uid2']) my_f_state.splice(arr2i,1);
}
			}
myStorage.setItem("my_f_state",JSON.stringify(my_f_state));
	
if(in_array_key(myuid,my_f_state,'uid2')){$('#f_star').addClass("fa-user-times");	$('#f_star').css("color","red");
  $('#f_star').css("background-color","#FFFFFF");$('#f_star').removeClass("fa-user-plus");}else{$('#f_star').addClass("fa-user-plus");$('#f_star').removeClass("fa-user-times");	$('#f_star').css("color","");
  $('#f_star').css("background-color","");}
}, function() {/*错误*/});
}
function in_array_key(id,myarr,key){
for (arr2i = 0;arr2i < myarr.length; arr2i++) {
if(id==myarr[arr2i][key]){return true;}
}return false;
}


var formatImg=function(html){ 
var newContent= html.replace(/<img[^>]*>/gi,function(match,capture){ 
match = match.replace(/inline=\"(.*)\"/gi, ''); 
match = match.replace(/img_width=\"(.*)\"/gi, ''); 
match = match.replace(/img_height=\"(.*)\"/gi, ''); 
return match;}); 
 return newContent.replace(/<p>[\s| ]*(<br[\s| \/]*>)*[\s| ]*<\/p>/gi,''); 
 } 
function uppase(obj,id){/*数据格式化*/
var alllist = document.getElementById(id).getElementsByTagName('*')
for(var i=0;i<alllist.length;i++){
alllist[i].innerHTML=$.trim(alllist[i].innerHTML);
alllist[i].removeAttribute("style");
alllist[i].removeAttribute("class");
alllist[i].removeAttribute("id");
alllist[i].removeAttribute("name");
alllist[i].removeAttribute("alt");
}
var imglist = document.getElementById(id).getElementsByTagName("img")
 if(imglist){
for(var i=0;i<imglist.length;i++){
imgu=imglist[i].getAttribute("src");
if(imgu.indexOf(bucketcdn )<0 && imgu.substr(0, 1)!='/'){
obj.text('up:'+i+'/'+imglist.length);
htmlobj=$.ajax({url:"/post/curl?q="+encodeURIComponent(imgu),async:false});
iu=htmlobj.responseText;
if(iu.indexOf("http")==0 || iu.substr(0, 1)=='/'){
imgwha =iu.split('@');
imglist[i].setAttribute("src",imgwha[0]);
if(imgwha.length>1){
imgwha2=imgwha[1].split('|');
if(imgwha2.length>1){
imgwha2[0]=Number(imgwha2[0]);
imgwha2[1]=Number(imgwha2[1]);
if(imgwha2[0]>680){
imglist[i].setAttribute("width",680);
imglist[i].setAttribute("height",Math.round(imgwha2[1]/imgwha2[0]*680));
}else{
imglist[i].setAttribute("width",imgwha2[0]);
imglist[i].setAttribute("height",imgwha2[1]);
}
}
}
}else{
swal.close;
obj.removeAttr('disabled');
obj.text(langfun('发送'));
setTimeout(swal(langfun('失败'), langfun('上传失败'), "error"),500);
return false;
}
}else{
console.log(imglist[i]);
imglist[i].setAttribute("src",imgu.replace('https://www.picadv.com/',bucketcdn));
if(imglist[i].width>0 && imglist[i].height>0){ 
imglist[i].setAttribute("width",imglist[i].width);	
imglist[i].setAttribute("height",imglist[i].height);	
}else{
imglist[i].removeAttribute("style");
imglist[i].removeAttribute("width");	
imglist[i].removeAttribute("height");	
	}

	}
}
}
swal.close;
postzhen(obj)
}


function dropdown(div){
	if($("#"+div).hasClass("open")){
	$("#"+div).removeClass("open");
	}else{
			$("#"+div).addClass("open");
		}
	}


function share(share_mode){
var share_param = {
URL: location.href,
TITLE: $(document).attr("title"),
DESCRIPTION: $('meta[property="og:description"]').attr("content"),
SOURCE: 'ysv8.com' ,
SITE_URL: 'ysv8.com', 
IMAGE: $('meta[property="og:image"]').attr("content"),
WEIBOKEY: '' ,
};

if(share_mode=='copy'){
swal({ 
  title: "copy",
  text: '<textarea class="input-text" node-type="textEl" range="5&amp;0" id="copy">'+$(document).attr("title")+' : '+location.href+'</textarea>', 
  html: true 
},
function(){ 
copy('copy');
});
return false;
}
if(share_mode=='qrcode'){
swal({ 
  title: "qrcode",
  text: '<div id="qrcode" style="width:150px;height:150px;text-align:center"></div>', 
  html: true 
});
if (typeof(Worker) !== "undefined") {
$("#qrcode").qrcode({
	render: "canvas",
	width: 150,
	height:150,
	text: location.href
});
}else{
	$("#qrcode").qrcode({
	render: "table",
	width: 150,
	height:150,
	text: location.href
});
	}
return false;
}
var share_link={digg:"https://digg.com/submit?phase=2&url={{URL}}&title={{TITLE}}",
skype:"https://web.skype.com/share?flowId=62047f520b5e464b07daf5c173e07bf4&url={{URL}}&source={{SOURCE}}",qzone:"https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={{URL}}&title={{TITLE}}&desc={{DESCRIPTION}}&summary={{DESCRIPTION}}&site={{SOURCE}}",qq:"https://connect.qq.com/widget/shareqq/index.html?url={{URL}}&title={{TITLE}}&source={{SOURCE}}&desc={{DESCRIPTION}}&pics={{IMAGE}}",tencent:"https://share.v.t.qq.com/index.php?c=share&a=index&title={{TITLE}}&url={{URL}}&pic={{IMAGE}}",weibo:"https://service.weibo.com/share/share.php?url={{URL}}&title={{TITLE}}&pic={{IMAGE}}&appkey={{WEIBOKEY}}",wechat:"javascript:;",douban:"https://shuo.douban.com/!service/share?href={{URL}}&name={{TITLE}}&text={{DESCRIPTION}}&image={{IMAGE}}&starid=0&aid=0&style=11",diandian:"https://www.diandian.com/share?lo={{URL}}&ti={{TITLE}}&type=link",linkedin:"https://www.linkedin.com/shareArticle?mini=true&ro=true&title={{TITLE}}&url={{URL}}&summary={{DESCRIPTION}}&source={{SOURCE}}&armin=armin",facebook:"https://www.facebook.com/sharer/sharer.php?u={{URL}}",twitter:"https://twitter.com/intent/tweet?text={{TITLE}}_{{URL}}&url={{URL}}&via={{SITE_URL}}",google:"https://plus.google.com/share?url={{URL}}",fav:"https://www.ysv8.com/fav/add.html?url={{URL}}&title={{TITLE}}"}
var mylink=share_link[share_mode];
for(var i in share_param) {
 if(Object.prototype.hasOwnProperty.call(share_param,i)) { //过滤
var reg = new RegExp( '{{'+i+'}}' , "g" )
mylink=mylink.replace(reg,encodeURIComponent(share_param[i]))
 }
 }
window.open(mylink);
 }
 function copy(id){
var Url2=document.getElementById(id);Url2.select();document.execCommand("Copy");swal('success','SUCCESS','success');}

function rehtml(obj){
return obj;
}

function nf(elem){
var imgsrc=elem.src;
if(imgsrc.indexOf('picadv.')==-1 && imgsrc.indexOf('huaren-hk.')==-1 && imgsrc.indexOf('44api.')==-1){
	elem.src='//i.44api.com/upload/logo/logo.jpeg';
	elem.onerror=null;
	return false;
	}
if(imgsrc.indexOf('_')==-1){ 
imgsrc=imgsrc.replace('www.picadv.com','huaren-hk.oss-cn-hongkong.aliyuncs.com'); 
elem.src=imgsrc+'_gif';
}else{
imgsrc = imgsrc.split('_')[0];
imgsrc=imgsrc.replace('www.picadv.com','huaren-hk.oss-cn-hongkong.aliyuncs.com'); 
elem.src=imgsrc+'_gif2';
}
elem.onerror=null;
}

$(document).ready(function(){$("#lang").click(function(){langhtml();});$(".menu-box").click(function(){$(".friend-box").toggleClass('friend-box-a');});});function in_array(stringToSearch,arrayToSearch){for(s=0;s<arrayToSearch.length;s++){thisEntry=arrayToSearch[s].toString();if(thisEntry==stringToSearch){return true;}}
return false;}