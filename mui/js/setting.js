
var next=false;

mui.init({});


 //初始化单页view
 var viewApi = mui('#app').view({
 defaultPage: '#setting'
 });
 //初始化单页的区域滚动
 mui('.mui-scroll-wrapper').scroll();
 //分享操作
 var shares = {};
 
 mui.plusReady(function() {
 plus.share.getServices(function(s) {
 if (s && s.length > 0) {
 for (var i = 0; i < s.length; i++) {
 var t = s[i];
 shares[t.id] = t;
 }
 }
 }, function() {
 console.log("获取分享服务列表失败");
 });
 });

 
 
 //检查更新
 document.getElementById("update").addEventListener('tap', function() {
 var server = "http://www.dcloud.io/check/update"; //获取升级描述文件服务器地址
 mui.getJSON(server, {
 "appid": plus.runtime.appid,
 "version": plus.runtime.version,
 "imei": plus.device.imei
 }, function(data) {
 if (data.status) {
 plus.ui.confirm(data.note, function(i) {
 if (0 == i) {
 plus.runtime.openURL(data.url);
 }
 }, data.title, [l[lang]['更新'], l[lang]['取消']]);
 } else {
 mui.toast(l[lang]['完毕'])
 }
 });
 });
 var view = viewApi.view;
 (function($) {
 //处理view的后退与webview后退
 var oldBack = $.back;
 $.back = function() {
 if (viewApi.canBack()) { //如果view可以后退，则执行view的后退
 viewApi.back();
 } else { //执行webview后退
 oldBack();
 }
 };
 //监听页面切换事件方案1,通过view元素监听所有页面切换事件，目前提供pageBeforeShow|pageShow|pageBeforeBack|pageBack四种事件(before事件为动画开始前触发)
 //第一个参数为事件名称，第二个参数为事件回调，其中e.detail.page为当前页面的html对象
 view.addEventListener('pageBeforeShow', function(e) {
 // console.log(e.detail.page.id + ' beforeShow');
 });
 view.addEventListener('pageShow', function(e) {
 // console.log(e.detail.page.id + ' show');
 });
 view.addEventListener('pageBeforeBack', function(e) {
  
  
 // console.log(e.detail.page.id + ' beforeBack');
 });
 view.addEventListener('pageBack', function(e) {
  // e.reload(true);
 // console.log(e.detail.page.id + ' back');
 });
 })(mui);
 //更换头像
 

 mui("#shejiao").on("tap", "a", function() {
  herf = this.getAttribute("herf");
  plus.runtime.openURL(herf);
  });
 mui("#my").on("tap", "a", function() {
  
  
  
herf = this.getAttribute("herf");
openurl(herf,herf);
  
  });
 
 mui(".mui-table-view-cell").on("tap", "#goodlike", function(e) {
   openurl('good.html','good');
 });
 
 mui(".mui-table-view-cell").on("tap", "#zzgg", function(e) {
openurl('https://'+lang+'.ysv8.com/user/ads.html','zzgg');
 });
 
 mui(".mui-table-view-cell").on("tap", "#jinshen", function(e) { 
mui.post(www+'open/jinshen',{YSV8_HEX:ysv8hex},function(fdata){
if(fdata['error']){muialert(fdata); return false;}
mui.alert(fdata['info']);
});
 
 });

 
 mui(".mui-table-view-cell").on("tap", "#head", function(e) {
 if(mui.os.plus){
 var a = [{
 title: l[lang]['拍照']
 }, {
 title: l[lang]['相册']
 }];
 plus.nativeUI.actionSheet({
 title: l[lang]['头像'],
 cancel: l[lang]['取消'],
 buttons: a
 }, function(b) {
 switch (b.index) {
 case 0:
 break;
 case 1:
 getImage();
 break;
 case 2:
 galleryImg();
 break;
 default:
 break
 }
 }) 
 }
 
 });

 function getImage() {
 var c = plus.camera.getCamera();
 c.captureImage(function(e) {
 plus.io.resolveLocalFileSystemURL(e, function(entry) {
 var s = entry.toLocalURL() ;
 console.log(s);
 document.getElementById("head-img").src = s;
 document.getElementById("head-img1").src = s;
 createUpload(s);
 
 //变更大图预览的src
 //目前仅有一张图片，暂时如此处理，后续需要通过标准组件实现
 document.querySelector("#__mui-imageview__group .mui-slider-item img").src = s;
 }, function(e) {
 console.log("读取拍照文件错误：" + e.message);
 });
 }, function(s) {
 console.log("error" + s);
 }, {
 filename: "_doc/head.jpg"
 })
 }

 function galleryImg() {
 plus.gallery.pick(function(a) {
 plus.io.resolveLocalFileSystemURL(a, function(entry) {
 plus.io.resolveLocalFileSystemURL("_doc/", function(root) {
 root.getFile("head.jpg", {}, function(file) {
 //文件已存在
 file.remove(function() {
 console.log("file remove success");
 entry.copyTo(root, 'head.jpg', function(e) {
  var e = e.fullPath;
  document.getElementById("head-img").src = e;
  document.getElementById("head-img1").src = e;
  createUpload(e);
  document.querySelector("#__mui-imageview__group .mui-slider-item img").src = e;
  },
  function(e) {
  console.log('copy image fail:' + e.message);
  });
 }, function() {
 console.log("delete image fail:" + e.message);
 });
 }, function() {
 //文件不存在
 entry.copyTo(root, 'head.jpg', function(e) {
  var path = e.fullPath + "?version=" + new Date().getTime();
  document.getElementById("head-img").src = path;
  document.getElementById("head-img1").src = path;
  //变更大图预览的src
  //目前仅有一张图片，暂时如此处理，后续需要通过标准组件实现
  document.querySelector("#__mui-imageview__group .mui-slider-item img").src = path;
 },
 function(e) {
  console.log('copy image fail:' + e.message);
 });
 });
 }, function(e) {
 console.log("get _www folder fail");
 })
 }, function(e) {
 console.log("读取拍照文件错误：" + e.message);
 });
 }, function(a) {}, {
 filter: "image"
 })
 };


 document.getElementById("head-img1").addEventListener('tap', function(e) {
 e.stopPropagation();
 });
 document.getElementById("welcome").addEventListener('tap', function(e) {
 //显示启动导航
 mui.openWindow({
 id: 'guide',
 url: 'guide.html',
 show: {
 aniShow: 'fade-in',
 duration: 300
 },
 waiting: {
 autoShow: false
 }
 });
 });

 function initImgPreview() {
 var imgs = document.querySelectorAll("img.mui-action-preview");
 imgs = mui.slice.call(imgs);
 if (imgs && imgs.length > 0) {
 var slider = document.createElement("div");
 slider.setAttribute("id", "__mui-imageview__");
 slider.classList.add("mui-slider");
 slider.classList.add("mui-fullscreen");
 slider.style.display = "none";
 slider.addEventListener("tap", function() {
 slider.style.display = "none";
 });
 slider.addEventListener("touchmove", function(event) {
 event.preventDefault();
 })
 var slider_group = document.createElement("div");
 slider_group.setAttribute("id", "__mui-imageview__group");
 slider_group.classList.add("mui-slider-group");
 imgs.forEach(function(value, index, array) {
 //给图片添加点击事件，触发预览显示；
 value.addEventListener('tap', function() {
 slider.style.display = "block";
 _slider.refresh();
 _slider.gotoItem(index, 0);
 })
 var item = document.createElement("div");
 item.classList.add("mui-slider-item");
 var a = document.createElement("a");
 var img = document.createElement("img");
 img.setAttribute("src", value.src.replace('_50',''));
 a.appendChild(img)
 item.appendChild(a);
 slider_group.appendChild(item);
 });
 slider.appendChild(slider_group);
 document.body.appendChild(slider);
 var _slider = mui(slider).slider();
 }
 }
 
 if(mui.os.stream){
 document.getElementById("check_update").display = "none";
 }
 
var loginButton = document.getElementById('loginb');
var regid='login';
var islogin=false;


 function regdiv(){
 if(regid=='login'){
document.getElementById("emaild").style.display="none";
document.getElementById("pass2d").style.display="none";
 }else if(regid=='add'){
 document.getElementById("emaild").style.display="block";
document.getElementById("pass2d").style.display="block";
 }
 
 }
function setdata(data){
	console.log(data);
 var div = document.getElementById("mui-reglogin"); 
 while(div.hasChildNodes()){ div.removeChild(div.firstChild); } 
if(typeof(data['hex'])!="undefined"){ 
 ysv8hex=data['hex'];
 localStorage.setItem("ysv8hex"+apiid,data['hex']);
 }
if(!data['error']){
islogin=true;
if(typeof(data['mygroup'])!="undefined"){ 
if(data['mygroup'].length>0){
localStorage.setItem("group"+apiid,JSON.stringify(data['mygroup']));
}
}
if(typeof(data['my'])!="undefined"){ 
localStorage.setItem("user"+apiid,JSON.stringify(data['my'])); /*布置缓存*/
setuserdata(data['my']);
 setTimeout(function() {initImgPreview();}, 1000);
}
//if(data['my']['rz']==0){
 // var li = document.createElement('li');
 // li.className = 'mui-table-view-cell';
 //li.innerHTML = '<a style="text-align: center;" onClick="mui(\'#rzdiv\').popover(\'toggle\');" id="rza">实名认证</a>';
 //div.appendChild(li); 
 // mui('#rzdiv').popover('toggle'); 
 //}
 var li = document.createElement('li');
 li.className = 'mui-table-view-cell';
 li.innerHTML = '<a style="text-align: center;color: #FF3B30;" id="out">'+l[lang]['退出']+'</a>';
 div.appendChild(li);
 
}else{
islogin=false;
document.getElementById('username').innerText=l[lang]['登录'];
document.getElementById('username1').innerText=l[lang]['登录'];
document.getElementById('user_gold').innerText=0;
document.getElementById('user_vip').innerText=0;
 var li = document.createElement('li');
 li.className = 'mui-table-view-cell';
 li.innerHTML = '<a style="text-align: center;color: #FF3B30;" id="regandlog">'+l[lang]['登录']+'</a>';
 div.appendChild(li);
 var gethtml=regdiv();
 mui('#logindiv').popover('toggle');
}

}




/*
mui("#rzdiv").on('tap','a',function(){
id = this.getAttribute("id");
if(id=='yzmb'){
mui.post(www+'open/mobile',{mobile:document.getElementById('mobile').value,YSV8_HEX:ysv8hex},function(data){
 if(!data['error']){
 mui.alert(data['info'])
 }else{
 mui.alert('验证码发送成功')
 }
 });
}
 if(id=="rzb"){
mui.post(www+'open/rz',{mobile:document.getElementById('mobile').value,yzm:document.getElementById('yzm').value,YSV8_HEX:ysv8hex},function(data){

 if(!data['error']){
 mui.alert(data['info'])
 }else{
 mui.alert('恭喜您！认证成功')
 mui('#rzdiv').popover('toggle');
 }


 });
 }
 
});
*/


mui("#mui-reglogin").on('tap','a',function(){
id = this.getAttribute("id");
if(id=="regandlog"){
var gethtml=regdiv();
 mui('#logindiv').popover('toggle');
 }
 
 if(id=="out"){
mui.post(www+'user/out.api',{type:'out',YSV8_HEX:ysv8hex},function(data){
 ysv8hex='no';
 localStorage.removeItem("ysv8hex"+apiid);
  localStorage.removeItem("user"+apiid);
  localStorage.removeItem("groupmy"+apiid);
setdata(data)
 });
 }
 
});
 
mui(".mui-content-padded").on('tap','a',function(){
id = this.getAttribute("id");
var idinner=this.innerText;
this.id=regid;
regid=id;
var gethtml=regdiv();
this.innerText=loginButton.innerText;
loginButton.innerText=idinner;
}); 


mui(".mui-content-padded").on('tap','button',function(){
 mui.post(www+'user/'+regid+'.api',{user:document.getElementById("user").value,pass:document.getElementById("pass1").value,pass2:document.getElementById("pass2").value,email:document.getElementById("email").value},function(data){
if(typeof(data['hex'])!="undefined"){ 
 ysv8hex=data['hex'];
 localStorage.setItem("ysv8hex"+apiid,data['hex']);
 }
mui('#logindiv').popover('toggle');
if(!data['error']){
mui.alert(data['info']);
mui('#logindiv').popover('toggle');
}else{
setTimeout(function() {mui.post(www+'user/get.api',{type:'get',YSV8_HEX:ysv8hex},function(data){setdata(data);});}, 500);
}

 });


}); 
 mui(".mui-bar-tab").on('tap','.mui-tab-item',function(){
id = this.getAttribute("her");
if(id!=null){
mui.openWindow({
url: id, 
id:id
});
}
}); 
 mui(".mui-row").on('tap','a',function(){
id = this.getAttribute("her");
if(id=="huishou"){

var mygold=document.getElementById('user_gold').innerText
if(mygold<15000){
mui.alert('您的金币不足15000','金币不足');
}else{
mui.post(www+'user/huishou',{type:'out',YSV8_HEX:ysv8hex},function(data){
if(data['error']==true){
mygold=document.getElementById('user_gold').innerText=data['gold'];
mui.alert(data.info,'提现成功');
 }else{
mui.alert(data.info,'失败');
 }
 });
}


return false;
}

if(id!=null){
mui.openWindow({
url: id, 
id:'nav'
});
}
}); 
(function($) {  
$.ready(function() {
setTimeout(function() {mui.post(www+'user/get.api',{YSV8_HEX:ysv8hex},function(data){setdata(data);});}, 500);
 });
})(mui);
function createUpload(img) {
 var task = plus.uploader.createUpload(www+'user/ava.api', { method:"POST",blocksize:204800,priority:100 },
 function ( t, status ) {
 if ( status == 200 ) { 
 if(t.error){mui.alert(t.info);}else{mui.toast(l[lang]['成功'],{ duration:'short', type:'div' }); } 
 } else {
 mui.toast(l[lang]['失败'] +':'+status,{ duration:'short', type:'div' });
 }
 }
 );
 task.addFile(img, {key:"photo"} );
 task.addData( "YSV8_HEX", ysv8hex );
 task.start();
}