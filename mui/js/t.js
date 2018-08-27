var deceleration = mui.os.ios?0.003:0.0009;
 var id=getQueryString("id")
 var dataa=[];
 var fyslef;
 var dataai=0;
 var pagtime=0;
  var moretime=0;
    var moreid=0;
	morebool=false;
 var classvlue ='topc1';
 var datalook=[];/*查看*/
 var datafav=[];/*收藏*/
 var datacom=[];/*评论*/
 var datadown=[];/*下载*/
 var plid=0;
var optionss=localStorage.getItem("datalook"+apiid); 
if(optionss){datalook=JSON.parse(optionss);}
var optionss=localStorage.getItem("datafav"+apiid); 
if(optionss){datafav=JSON.parse(optionss);}
var optionss=localStorage.getItem("datacom"+apiid); 
if(optionss){datacom=JSON.parse(optionss);}
var optionss=localStorage.getItem("datadown"+apiid); 
if(optionss){datadown=JSON.parse(optionss);}
document.getElementById("share").addEventListener('tap', function() {
	mui('#share_list').popover('toggle');
});
function in_array2(id,myarr){
for (arr2i = 0;arr2i < myarr.length; arr2i++) {
if(id==myarr[arr2i]['id']){
return true;
}
}
return false;
}
function add_array(arr,myarr){
for (arr2i = 0;arr2i < myarr.length; arr2i++) {
if(arr['id']==myarr[arr2i]['id']){
var news_sub={
 id:myarr[arr2i]['id'],
  user:myarr[arr2i]['user'],
 btime:myarr[arr2i]['btime'],
 img:myarr[arr2i]['img'],
 gold:myarr[arr2i]['gold'],
 mode:myarr[arr2i]['mode'],
 posts:myarr[arr2i]['posts'],
 title:myarr[arr2i]['title'],
 vs:myarr[arr2i]['vs'],
 }
myarr.push(news_sub);
myarr.splice(arr2i,1);
return myarr;
}
}

if(myarr.length>100){
myarr.splice(0,10);
}
if(typeof(arr['user'])=="undefined"){ 
var myuser=arr['user'];
}else{
var myuser=arr['user'];	
	}

var news_sub={
 id:arr['id'],
  user:myuser,
 btime:arr['btime'],
 img:arr['img'],
 gold:arr['gold'],
 mode:'t',
 posts:arr['posts'],
 title:arr['title'],
 vs:arr['vs'],
 }
myarr.push(news_sub);
return myarr;
}
function add_fav(arr){

for (arr2i = 0;arr2i < datafav.length; arr2i++) {
if(arr['id']==datafav[arr2i]['id']){
datafav.splice(arr2i,1);
return false;
}
}
if(datafav.length>100){
datafav.splice(0,10);
}
var news_sub={
 id:arr['id'],
  user:arr['user'],
 btime:arr['btime'],
 img:arr['img'],
 gold:arr['gold'],
 mode:arr['mode'],
 posts:arr['posts'],
 title:arr['title'],
 vs:arr['vs'],
 }
datafav.push(news_sub);
return true;
}
mui(".pl-input-box").on('tap','button',function(){
var _obj = this;
_obj.disabled=true;
_obj.innerText="...";
var content2=document.getElementById('content2').value;
 mui.post(www+'comment/'+id+'.api',{pid:plid,content:content2,YSV8_HEX:ysv8hex},function(data){
 var pltable = document.body.querySelector('.pullrefresh-view'); 
 if(data.error){
 var li = document.createElement('li');
 li.className = 'mui-table-view-cell mui-media';
 li.innerHTML = '<img class="mui-media-object mui-pull-left" src="'+bucketcdn+userdata['avatar']+'_80"><div class="mui-media-body">'+l[lang]['自己']+'<p>'+content2.replace("\n","<br>");+'</p><p><span class="modetext">'+l[lang]['刚刚']+'</span></p></div>';
pltable.appendChild(li);
datacom =add_array(datalook[datalook.length-1],datacom)
var str = JSON.stringify(datacom); 
localStorage.setItem("datacom"+apiid,str);
mui.alert(data.info,l[lang]['成功']);
document.getElementById('content2').value='';
mui('#sheet1').popover('toggle');
 }else{
muialert(data);
 }
 _obj.disabled=false;
 _obj.innerText=l[lang]['发送'];
},'json'
);



}); 
document.getElementById("posts").addEventListener('tap', function() {
plid=0;
document.getElementById('aid').innerHTML="";
mui('#sheet1').popover('toggle');
});
document.getElementById("posts2").addEventListener('tap', function() {
plid=0;
document.getElementById('aid').innerHTML="";
mui('#sheet1').popover('toggle');
});
mui("nav").on('tap','button',function(){
plid=0;
document.getElementById('aid').innerHTML="";
mui('#sheet1').popover('toggle');
}); 
mui(".pullrefresh-view").on('tap','span',function(){
id = this.getAttribute("data-id");
size = this.getAttribute("data-size");
var _obj=this;
if(id>0 && size ){
 mui.post(www+'Comment/vote.api',{type:size,id:id,YSV8_HEX:ysv8hex},function(data){
if(data['error']){
mui.alert(data['info'],l[lang]['失败']);
}else{
classname=_obj.getAttribute("class")
_obj.className = classname+' red';
it=parseInt(_obj.innerText);
_obj.innerText = it+1;
_obj.id=0;
}
},'json');

}
}); 

mui(".content").on('tap','span',function(){
id = this.getAttribute("id");
size = this.getAttribute("size");
var _obj=this;
if(id>0){
 mui.post(www+'thread/vote.api',{type:size,id:id,YSV8_HEX:ysv8hex},function(data){
if(data['error']){
muialert(data);
}else{
classname=_obj.getAttribute("class")
_obj.className = classname+' red';
it=parseInt(_obj.innerText);
_obj.innerText = it+1;
_obj.id=0;
}
},'json');

}
}); 


mui(".content").on('tap','.filedowna',function(){
id = this.getAttribute("data-id");
swal({ 
title: l[lang]['警告'], 
text: "-G200", 
type: "info", 
showCancelButton: true, 
closeOnConfirm: false, 
confirmButtonText: l[lang]['确认'], 
cancelButtonText: l[lang]['取消'],
showLoaderOnConfirm: true, 
},
function(){ 
swal.close();
for (arr2i = 0;arr2i < datadown.length; arr2i++) {
if(id==datadown[arr2i]['id']){createDownload(datadown[arr2i]['info']);return false;}
}

mui.get(www+'ajax/downfile.api?id='+ id,{YSV8_HEX:ysv8hex},function(data){
if(data['error']){
if(datadown.length>100){datadown.splice(0,10);}
var news_sub={id:id,info:data['info']}
datadown.push(news_sub);
localStorage.setItem("datadown"+apiid,JSON.stringify(datadown));
createDownload(data['info']);
}else{muialert(data);}
});
});
});

window.onscroll = function () { 
if (getScrollTop() + getClientHeight() == getScrollHeight()) { 
set_pl_html();
} 
} 
var plbool=false;
function set_pl_html(){
if(plbool){return false;}
if(pagtime>0){
var ajaxurl=www+'comment/'+id+'.api?pageid='+pagtime;
}else{
	var ajaxurl=www+'t/'+id+'.api'
	
	}

mui.post(ajaxurl,{YSV8_HEX:ysv8hex},function(data){
if(pagtime==0){
 var table = document.body.querySelector('.content');
if("undefined" == typeof data['thread']){
mui.alert(l[lang]['失败']);
}else{
if(typeof(data['hex'])!="undefined"){ 
 rndhex=data['hex'];
 localStorage.setItem("rndhex"+apiid,data['hex']);
 }
datalook =add_array(data['thread'],datalook)
var str = JSON.stringify(datalook); 
localStorage.setItem("datalook"+apiid,str);
if(in_array2(data['thread']['id'],datafav)){
document.getElementById('fav').className ='mui-icon mui-icon-star red';
}else{
document.getElementById('fav').className ='mui-icon mui-icon-star';
}
document.title =data['thread']['title'];
document.getElementById('posts').innerHTML=data['thread']['posts'];
document.getElementById('title').innerHTML='YSV8.COM';

if (typeof(data['topid']) == "object") sethtml(data['topid'],document.getElementById('topdata'),'-1','up')

 /*关注*/
if(in_myfr(data['thread']['uid'])){
thismy='<span class="modetext" dataid="'+data['thread']['uid']+'" datasize="friend_state" dataname="'+data['thread']['user']+'" style="padding:10px">'+l[lang]['已关注']+'</span><br><span class="nomodetext" data-uid="'+data['thread']['uid']+'" data-user="'+data['thread']['user']+'" data-ava="upload/'+data['thread']['avatar']+'_50">'+l[lang]['聊天']+'</span></div>';
}else{
thismy='<span class="nomodetext" dataid="'+data['thread']['uid']+'" datasize="friend_state"  dataname="'+data['thread']['user']+'" style="padding:5px">'+l[lang]['关注']+'</span><br><span class="nomodetext" data-uid="'+data['thread']['uid']+'" data-user="'+data['thread']['user']+'" data-ava="upload/'+data['thread']['avatar']+'_50">'+l[lang]['聊天']+'</span></div>';
}
guanzhu='<div class="mui-row"><div class="mui-col-sm-8 mui-col-xs-8"><div class="mui-table-view-cell mui-media"><img class="mui-media-object mui-pull-left" src="'+bucketcdn+data['thread']['avatar']+'_80" style="border-radius:30px; margin:5px;width:50px; height:50px;"><div class="mui-media-body"><a her="lo.html" id="'+data['thread']['uid']+'" posttype="uid_get" class="lo">'+data['thread']['user']+'</a><p class="mui-ellipsis">'+timeStamp2String(data['thread']['atime'])+'</p></div></div></div><div class="mui-col-sm-4 mui-col-xs-4">'+thismy+'</div></div>';

if(data['thread']['vs']!=''){
 var vs = document.body.querySelector('.vs');
 var li = document.createElement('div');
 li.className = 'mui-table-view-cell mui-media';
 li.innerHTML = '<video controls="controls" autoplay="autoplay"><source src="'+bucketcdn+data['thread']['vs'].replace('{m}','')+'" type="video/mp4"></video>';
 vs.appendChild(li);
 classvlue="topc2";
}
var reg = "/<img /g";
 var li = document.createElement('div');
 li.className = 'mui-table-view-cell mui-media '+classvlue;
 li.innerHTML = '<h2 class="fy">'+data['thread']['title']+'</h2>'+guanzhu+'<div class="fy">'+data['PostData'].replace(eval(reg),'<img data-preview-src="" data-preview-group="1" ')+'</div>';
 table.appendChild(li);
 

 

/*关注完*/
 
 
 for (i = 0;i < data['files'].length; i++) {
 var li = document.createElement('div');
 li.className = 'filedown mui-ellipsis-2';
 li.innerHTML = '<a class="filedowna" data-id="'+data['files'][i]['id']+'"><span class="mui-icon mui-icon-pulldown"></span>'+data['files'][i].filename+'.'+data['files'][i].ext+'</a>';
 table.appendChild(li);
 } 

var li = document.createElement('div');
 li.className= 'shang'
li.innerHTML = '<span id="shang" data-id='+data['thread']['uid']+'>'+l[lang]['赏']+'</span>';
table.appendChild(li);
var li = document.createElement('div');
 li.className = 'tupdown mui-table-view-cell';
 li.innerHTML = '<span class="mui-icon mui-icon-chatbubble"></span>'+data['thread']['posts']+'<div class="mui-pull-right plupdown"><span class="mui-icon-extra mui-icon-extra-like" id="'+data['thread']['id']+'" size="goods">'+data['thread']['goods']+'</span><span class="mui-icon mui-icon-trash" id="'+data['thread']['id']+'" size="nos">'+data['thread']['nos']+'</span></div>';
table.appendChild(li);


setTimeout(function() {mui.previewImage();},500);

  if(typeof(data['ads'])!="undefined"){ 
	var li = document.createElement('div');
   li.className = 'a46060';	
	li.innerHTML = '<img class="ads" data-si="'+data['ads']['size']+'" data-id="'+data['ads']['id']+'" src="'+data['ads']['img']+'_'+data['ads']['size']+'" />';
     table.appendChild(li);
}
thismy='';
thisgold='';


var li = document.createElement('div');
      li.className = 'mui-table-view-cell mui-media';
      li.innerHTML = '<div class="mui-row"><div class="mui-col-sm-8 mui-col-xs-8"><img class="mui-media-object mui-pull-left" src="'+bucketcdn+data['fdate']['avatar']+'_80" style="border-radius:30px; margin:5px;width:50px; height:50px;><div class="mui-media-body"><a her="lo.html" id="'+data['fdate']['id']+'" posttype="forum_get" class="lo">'+data['fdate']['name']+'</a><p class="mui-ellipsis">'+thisgold+'</p></div><div class="mui-col-sm-4 mui-col-xs-4">'+thismy+'</div></div>';
      table.appendChild(li);
}
}
var pltable = document.body.querySelector('.pullrefresh-view'); 
if(data['PostList'].length>0){
 var pltable = document.body.querySelector('.pullrefresh-view'); 
 for (i = 0;i < data['PostList'].length; i++) { 
  if(pagtime>data['PostList'][i]['btime'] || pagtime==0){pagtime=data['PostList'][i]['btime']}
 var li = document.createElement('li');
 li.className = 'mui-table-view-cell mui-media';
  li.innerHTML = '<img class="mui-media-object mui-pull-left" style="border-radius:15px;" src="'+bucketcdn+data['PostList'][i]['avatar']+'_80"><div class="mui-media-body"><div class="fy">'+data['PostList'][i]['content']+'</div><p>'+timeStamp2String(data['PostList'][i]['atime'])+'</p><div><span class="plhuifu" data-id="'+data['PostList'][i]['id']+'">'+data['PostList'][i]['user']+'</span>&nbsp;<span class="mui-icon mui-icon-chat plpost" data-id="'+data['PostList'][i]['id']+'" data-post="'+data['PostList'][i]['posts']+'">'+data['PostList'][i]['posts']+'</span><div class="mui-pull-right plupdown"><span class="mui-icon-extra mui-icon-extra-like" data-id="'+data['PostList'][i]['id']+'" data-size="goods">'+data['PostList'][i]['goods']+'</span>&nbsp;<span class="mui-icon mui-icon-trash" data-id="'+data['PostList'][i]['id']+'" data-size="nos">'+data['PostList'][i]['nos']+'</span></div></div></div>';
pltable.appendChild(li);
 }
}
if(data['PostList'].length<10){
plbool=true;
var li = document.createElement('div');
li.className = 'mui-table-view-cell mui-media ';
li.innerHTML = '<center>'+l[lang]['完毕']+'</center>';
pltable.appendChild(li);
}else{
	 if(typeof(data['ads'])!="undefined"){ 
	var li = document.createElement('div');
   li.className = 'a46060';	
	li.innerHTML = '<img class="ads" data-si="'+data['ads']['size']+'" data-id="'+data['ads']['id']+'" src="'+data['ads']['img']+'_'+data['ads']['size']+'" />';
     pltable.appendChild(li);
}
	
	}

},'json'
);

}


 (function($){
 $.ready(function() {
 ajaxbool=false;
 mui("div").on('tap','span',function(){/*关注*/
 var thisself=this;
 var datasize=thisself.getAttribute('datasize');
 if(!datasize){
	 uid=thisself.getAttribute('data-uid');
	 user=thisself.getAttribute('data-user');
	 	 ava=thisself.getAttribute('data-ava');
		 if(uid){openurl('chat.html?uid='+uid+'&user='+user+'&ava='+ava,'chat'+uid);}
		 
	 }
id = this.getAttribute("dataid");
if(!datasize || id<1) return false;
 mui.post(www+'open/'+thisself.getAttribute('datasize'),{id:id,YSV8_HEX:ysv8hex,rndhex:rndhex},function(data){ 
  if(data['error']==false){
   mswal(data);
  return false;
  }
 if(data['id']){
 //删除id
 if(datasize=='friend_state'){ add_myfr(id,thisself.getAttribute('dataname'),'add');}else{
 add_f(id,thisself.getAttribute('dataname'),'add');
 }
 
 thisself.setAttribute("class", "modetext"); 
 thisself.innerHTML=l[lang]['已关注'];
 }else{
  if(datasize=='friend_state'){ add_myfr(id,thisself.getAttribute('dataname'),'del');}else{
 add_f(id,thisself.getAttribute('dataname'),'del');
 }
  thisself.setAttribute("class", "nomodetext"); 
 thisself.innerHTML=l[lang]['关注'];
 }
 },'json'
);
});
 
document.getElementById("fav").addEventListener('tap', function() {
var gethtml=add_fav(datalook[datalook.length-1]);
if(gethtml){
document.getElementById('fav').className ='mui-icon mui-icon-star red';
}else{
document.getElementById('fav').className ='mui-icon mui-icon-star';
}
var str = JSON.stringify(datafav); 
localStorage.setItem("datafav"+apiid,str);
}); 
 
mui("#share_list").on('tap','a',function(){/*关注*/
id = this.getAttribute("id");
share(id,'t');
mui('#share_list').popover('toggle');
});   

mui("div").on('tap','#shang', function() {
uid=this.getAttribute("data-id");
mui.post(www+'open/shang',{uid:uid,YSV8_HEX:ysv8hex},function(fdata){
if(fdata['error']){muialert(fdata); return false;}
mui.alert(fdata['info']);
});
});

mui(".content").on('tap','.ads',function(){
id=this.getAttribute("data-id");
si=this.getAttribute("data-si");

plus.runtime.openURL('https://'+lang+'.ysv8.com/ads?id='+id+'&si='+si);

});	
mui("#pullrefresh").on('tap','.plhuifu',function(){
id=this.getAttribute("data-id");
document.getElementById('aid').innerHTML="@"+id;
plid=id;
mui('#sheet1').popover('toggle');
});	


function getmorepl(){
	if(morebool) return false;
	morebool=true;
	mui.post(www+'Comment/more/'+moreid+'.api',{pageid:moretime,YSV8_HEX:ysv8hex},function(data){
if(data['error']){muialert(data); return false;}
var pltable = document.body.querySelector('#pldiv'); 

if(data['PostList'].length>0){
 for (i = 0;i < data['PostList'].length; i++) { 
  if(moretime>data['PostList'][i]['btime'] || moretime==0){moretime=data['PostList'][i]['btime']}
 var li = document.createElement('li');
 li.className = 'mui-table-view-cell mui-media';
  li.innerHTML = '<img class="mui-media-object mui-pull-left" style="border-radius:15px;" src="'+bucketcdn+data['PostList'][i]['avatar']+'_80"><div class="mui-media-body"><div class="fy">'+data['PostList'][i]['content']+'</div><p>'+timeStamp2String(data['PostList'][i]['atime'])+'</p><div><span class="plhuifu">'+data['PostList'][i]['user']+'</span><div class="mui-pull-right plupdown"><span class="mui-icon-extra mui-icon-extra-like" data-id="'+data['PostList'][i]['id']+'" data-size="goods">'+data['PostList'][i]['goods']+'</span>&nbsp;<span class="mui-icon mui-icon-trash" data-id="'+data['PostList'][i]['id']+'" data-size="nos">'+data['PostList'][i]['nos']+'</span></div></div></div>';
pltable.appendChild(li);
 }
}
if(data['PostList'].length<10){
morebool=true;
var li = document.createElement('div');
li.className = 'mui-table-view-cell mui-media ';
li.innerHTML = '<center>'+l[lang]['完毕']+'</center>';
pltable.appendChild(li);
}else{
	morebool=false;
	
	}

},'json'
);	
	
	}
document.getElementById("jiazai").addEventListener('tap', function() {
getmorepl();
});
mui("#pullrefresh").on('tap','.plpost',function(){
document.getElementById('pldiv').innerHTML="";										
id=this.getAttribute("data-id");
posts=this.getAttribute("data-post");
if(posts>0){
mui('#plpost').popover('toggle');
moretime=0;
moreid=id;
morebool=false;
getmorepl();
	
	}
});

$(".topdata").on('tap','a',function(){
herf = this.getAttribute("herf");
mui.openWindow({
id: herf, 
url:'t.html?id='+herf
});
}); 

mui("body").on('tap','.fy',function(){							
fyslef=this;
mui('#fy_list').popover('toggle');
});	
mui(".content").on('tap','.lo',function(){/*关注*/
 var name=this.innerText;
id = this.getAttribute("id");
her = this.getAttribute("her");
posttype= this.getAttribute("posttype");
 mui.openWindow({
url: her+'?id='+id+'&name='+encodeURI(name)+'&posttype='+encodeURI(posttype), 
id:her
});
});   
  
setTimeout(function() {var gethtml=set_pl_html();},500);}); 
 
})(mui); 
 
 function createDownload(url) {
	 plus.runtime.openURL(url);
}
function copyToClip(e) {
if (mui.os.android) {
var c = plus.android.importClass("android.content.Context");
var a = plus.android.runtimeMainActivity();
var d = a.getSystemService(c.CLIPBOARD_SERVICE);
plus.android.invoke(d, "setText", e);
} else {
if (mui.os.ios) {
var b = plus.ios.importClass("UIPasteboard");
var f = b.generalPasteboard();
f.setValueforPasteboardType(e, "public.utf8-plain-text");
}
}
}

document.getElementById("copy").addEventListener('tap', function() {
mui('#fy_list').popover('toggle');	
copyToClip(fyslef.innerText);
mui.toast(l[lang]['复制']+':'+l[lang]['成功'],{ duration:'short', type:'div' });
	
});
document.getElementById("fy_now").addEventListener('tap', function() {
mui('#fy_list').popover('toggle');
mui.post(www+'open/fy',{str:fyslef.innerText,lang:lang},function(fdata){													 
var li = document.createElement('div');
li.className = 'fycontent';
li.innerHTML = nl2br(fdata['data']);
fyslef.appendChild(li);
fyslef.setAttribute("class","ok");
});	
});