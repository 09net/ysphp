groupmyi=0;
var fristget=true;
var optionss=localStorage.getItem("groupmy"+apiid); 
if(optionss){var group=JSON.parse(optionss);
group.unshift({name:l[lang]['悬赏'],id:-2,size:1},{name:l[lang]['综合'],id:-1,size:3});
var groupmyi=0; }else{
var groupmyi=0; 
var group=[{name:l[lang]['悬赏'],id:-2,size:1},{name:l[lang]['综合'],id:-1,size:3}];
}
wgroup(group);
mui.init({swipeBack:true,beforeback: function(){}});
document.getElementById('usermess').addEventListener('tap', function() {openurl('chat.html','chat');});
function setdowndata(data2,id,table){
var data=data2['data'];
wdata=data2['weibo'];
loadi=0;
loadni=0;
wbi=0;
wbni=0;

if(typeof(data2['us'][0])!="undefined"){ setuserdata(data2['us'][0]);}
for (i = wdata.length-1;i >-1; i--) {sethtml_weibo(wdata[i],table,id,'down');} 
for (i = data.length-1;i >-1; i--) {sethtml(data[i],table,id,'down');} 
if(typeof(data2['ads'])!="undefined" && loadni>5){ 
 var li = document.createElement('div');
 li.className = 'a46060'; 
 li.innerHTML = '<img class="ads" data-si="'+data2['ads']['size']+'" data-id="'+data2['ads']['id']+'" src="'+data2['ads']['img']+'_'+data2['ads']['size']+'" />';
 table.insertBefore(li, table.firstChild);
}
mui('.mui-scroll-wrapper').scroll({bounce: false,indicators: true,deceleration:deceleration});}
function getdowndata(self,id,table){
if(ajaxbool){if(typeof(self)=="object"){self.endPullDownToRefresh();}return;}

if(fristget){/*缓存系统*/
fristget=false;
if(typeof(plus)!="undefined"){
optionss=plus.storage.getItem(lang+'.'+id+'.'+type+'.'+apiid);
if(optionss){data2=JSON.parse(optionss);setdowndata(data2,id,table);return ;}
}
}
if(id>0){ajaxurl= www+'f/'+id+'/'+type+'/'+pagtime+'.api';}else{
	ajaxurl= www+'index/index/'+type+'/'+pagtime+'.api'
	}

ajaxbool=true;
mui.post(ajaxurl,{YSV8_HEX:ysv8hex},function(data2){ 
if(typeof(plus)!="undefined") plus.storage.setItem(lang+'.'+id+'.'+type+'.'+apiid, JSON.stringify(data2));

 groupmyi=1;
 if(typeof(data2['bucketcdn'])!="undefined"){localStorage.setItem("bucketcdn"+apiid,data2['bucketcdn']); var bucketcdn=data2['bucketcdn']; }
 if(typeof(data2['imgcdn'])!="undefined"){localStorage.setItem("imgcdn"+apiid,data2['imgcdn']); var imgcdn=data2['imgcdn']; }
if(typeof(data2['forum'])=="object" && data2['forum'].length>0){localStorage.setItem("groupmy"+apiid,JSON.stringify(data2['forum']));}
var data=data2['data'];
loadi=0;
loadni=0;
if(typeof(data2['us'])!="undefined" && typeof(data2['us'][0])!="undefined"){ 
localStorage.setItem("user",JSON.stringify(data2['us'][0])); /*布置缓存*/
setuserdata(data2['us'][0]);
}


for (i = data.length-1;i >-1; i--) {sethtml(data[i],table,id,'down')} 
if(typeof(self)=="object"){self.endPullDownToRefresh(); } 
 
 if(typeof(data2['ads'])!="undefined" && loadni>5){ 
 var li = document.createElement('div');
 li.className = 'a46060'; 
 li.innerHTML = '<img class="ads" data-si="'+data2['ads']['size']+'" data-id="'+data2['ads']['id']+'" src="'+data2['ads']['img']+'_'+data2['ads']['size']+'" />';
 table.insertBefore(li, table.firstChild);
}
 
 mui.toast(l[lang]['更新']+' +'+loadni,{ duration:'short', type:'div' });
 mui('.mui-scroll-wrapper').scroll({
bounce: false,
indicators: true,
deceleration:deceleration
});
 ajaxbool=false
 },'json'
);
}
function getupdata(self,id,table){
if(ajaxbool){self.endPullUpToRefresh(false);return;}
 ajaxbool=true;
if(id>0){ajaxurl= www+'f/'+id+'/'+type+'/'+pagtime+'.api';}else{
	ajaxurl=www+'index/index/'+type+'/'+pagtime+'.api'
	}
 mui.post(ajaxurl,{YSV8_HEX:ysv8hex},function(data2){
var data=data2['data'];
loadi=0;
loadni=0;
wbi=0;
wbni=0;


for (i = 0;i < data.length; i++) {
if(i==0 && typeof(data2['ads'])!="undefined"){setads(table,data2['ads']);}
sethtml(data[i],table,id,'up');
}
mui.toast(l[lang]['加载']+' +'+loadi,{ duration:'short', type:'div' });
mui('.mui-scroll-wrapper').scroll({bounce: false,indicators: true,deceleration:deceleration});
if(loadi<10) pagtime=99;
if(loadi<10){
self.endPullUpToRefresh(true); 
var li = document.createElement('li');
 li.className = 'mui-table-view-cell mui-media';
 li.innerHTML = '<p style="text-align:center">'+l[lang]['完毕']+'</p>';
 table.appendChild(li);
}else{
self.endPullUpToRefresh(false);
 }
 ajaxbool=false
 },'json'
);
}
mui.plusReady(function() {
var showGuide = localStorage.getItem("lauchFlag");
if(showGuide) {} else {
mui.openWindow({id: 'guide',url: 'guide.html'}); 
}		   
					   });
var slideNumber=1;
var deceleration = mui.os.ios?0.003:0.0009;
(function($) {
$('.mui-scroll-wrapper').scroll({
bounce: false,
indicators: true,
deceleration:deceleration
});


$.ready(function() {
		
		
		
$.each(document.querySelectorAll('.mui-slider-group .mui-scroll'), function(index, pullRefreshEl) {
var selfid=pullRefreshEl.getAttribute("did");
$(pullRefreshEl).pullToRefresh({
down: {
callback: function() {
var self = this;
setTimeout(function() {
getdowndata(self,selfid,self.element.querySelector('.mui-table-view'));
  }, 1000);
 }
 },
 up: {
 contentrefresh: '.....',
 callback: function() {
  var self = this;
  setTimeout(function() {
  getupdata(self,selfid,self.element.querySelector('.mui-table-view'));
  }, 1000);
 }
 }
 });
/*幻灯片事件*/ 
document.querySelector('.mui-slider').addEventListener('slide', function(event) {
if(slideNumber!=event.detail.slideNumber){
 ajaxbool=false;
var fristget=true;
pagtime=0;/*重新设置*/
getdowndata('no',document.getElementById('ms'+event.detail.slideNumber).getAttribute("did"),document.getElementById('mv'+event.detail.slideNumber));
slideNumber=event.detail.slideNumber;
}

});
/*底部导航*/ 
var herid='f0';
/*下部导航*/


$(".mui-bar-tab").on('tap','.mui-tab-item',function(){
herf = this.getAttribute("herf");
id = this.getAttribute("id");
mui.openWindow({
url: herf, 
id:id
});
}); 
/*搜索*/
mui(".mui-slider-group").on('tap','.ads',function(){
id=this.getAttribute("data-id");
si=this.getAttribute("data-si");

plus.runtime.openURL('https://'+lang+'.ysv8.com/ads?id='+id+'&si='+si);

}); 

mui(".mui-row").on('tap','.mui-search',function(){
var gethtml=sreachsub();
}); 

/*列表*/
mui(".mui-slider-group").on('tap','a',function(){
 id = this.getAttribute("herf");
 mui.openWindow({
 url: 't.html?id='+id, 
 id:'id'
 });
});

mui(".mui-slider-group").on('tap','.weibot',function(){
 id = this.getAttribute("data-id");
 mui.openWindow({
 url: 'wt.html?id='+id, 
 id:'id'
 });
});
mui("#user").on("tap","a",function(){openurl('setting.html','setting');});
mui("#post").on("tap","span",function(){openurl('post.html','post');});
/*更多*/ 
 mui(".rbar").on('tap','.more',function(){
 mui.openWindow({
 url: 'more.html', 
 id:'more'
 });
 });
/*user*/


/*微博顶踩*/
mui(".mui-slider-group").on('tap','span',function(){
id = this.getAttribute("data-id");
size = this.getAttribute("size");
var _obj=this;
if(!in_array(id,vote_data)){
return false;
}
vote_data.push(id);
if(id>0){
mui.post(www+'open/weibo_vote',{type:size,id:id},function(data){
if(!data['error']){
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
setTimeout(function() {getdowndata('no',document.getElementById('ms1').getAttribute("did"),document.getElementById('mv1'));}, 500);
});
});
})(mui);