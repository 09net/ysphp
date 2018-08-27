var data={};
var uid1=0;
var pw='';
var uid=getQueryString("uid");
var user=getQueryString("user");
var ava=getQueryString("ava");
var table = document.body.querySelector('#msg-list');
			mui.init({
				swipeBack: false,
			});
			 //侧滑容器父节点
			var offCanvasWrapper = mui('#offCanvasWrapper');
			 //主界面容器
			var offCanvasInner = offCanvasWrapper[0].querySelector('.mui-inner-wrap');
			 //菜单容器
			var offCanvasSide = document.getElementById("offCanvasSide");
			
			 //移动效果是否为整体移动
			var moveTogether = false;
			 //侧滑容器的class列表，增加.mui-slide-in即可实现菜单移动、主界面不动的效果；
			var classList = offCanvasWrapper[0].classList;
			 //变换侧滑动画移动效果；
			
			document.getElementById('offCanvasShow').addEventListener('tap', function() {
				offCanvasWrapper.offCanvas('show');
			});

			document.getElementById('clear_mess').addEventListener('tap', function() {
mui.post(www+'ajax/clear_mess.api',{uid:-1,YSV8_HEX:ysv8hex},function(fdata){
if(typeof(value)=="undefined" && fdata['error']){muialert(fdata); return false;}
mui.alert(fdata['info']);
});
			});
			
				document.getElementById('guanzhu').addEventListener('tap', function() {
 mui.post(www+'Friend/friend_state.api',{uid:uid,YSV8_HEX:ysv8hex},function(data){ 
  if(data['error']==false){
   muialert(data);
  return false;
  }
 if(data['id']){
	 add_myfr(uid,user,'add');
	 document.getElementById('guanzhu').innerText=l[lang]['已关注'];
	document.getElementById('guanzhu').setAttribute('class','mui-pull-right modetext');
	 
	 }else{
	 add_myfr(uid,user,'del');
	document.getElementById('guanzhu').innerText=l[lang]['关注'];
	document.getElementById('guanzhu').setAttribute('class','mui-pull-right nomodetext');
	 
	 }
			});
			});
			
			document.getElementById('setting').addEventListener('tap', function() {
				openurl('setting.html','setting');
			});
			
			document.getElementById('offCanvasHide').addEventListener('tap', function() {
				offCanvasWrapper.offCanvas('close');
			});
			 //主界面和侧滑菜单界面均支持区域滚动；
			mui('#offCanvasSideScroll').scroll();
			mui('#offCanvasContentScroll').scroll();
			 //实现ios平台的侧滑关闭页面；
			if (mui.os.plus && mui.os.ios) {
				offCanvasWrapper[0].addEventListener('shown', function(e) { //菜单显示完成事件
					plus.webview.currentWebview().setStyle({
						'popGesture': 'none'
					});
				});
				offCanvasWrapper[0].addEventListener('hidden', function(e) { //菜单关闭完成事件
					plus.webview.currentWebview().setStyle({
						'popGesture': 'close'
					});
				});
			}
/*getmsg=function(uid){
mui.post(www+'open/get_old_chat',{YSV8_HEX:ysv8hex,uid:uid},function(fdata){

console.log(fdata);
});


}*/

function setchat(){
	
	document.getElementById('offCanvasShow').innerText=user;

if(in_myfr(uid)){
	
	document.getElementById('guanzhu').innerText=l[lang]['已关注'];
	document.getElementById('guanzhu').setAttribute('class','mui-pull-right modetext');

}else{
document.getElementById('guanzhu').innerText=l[lang]['关注'];
	document.getElementById('guanzhu').setAttribute('class','mui-pull-right nomodetext');
}

document.getElementById('msg-list').innerText='';
mui.post(www+'Friend/get_old_chat.api',{YSV8_HEX:ysv8hex,uid:uid},function(fdata){

for(i  in fdata){ 
var li = document.createElement('div');
if(fdata[i]['uid1']==uid){
	if(fdata[i]['size']==4){
					fdata[i]['content']=l[fdata[i]['content']];
					}
	if(fdata[i]['size']==2){f='('+l[lang]['加密发送']+')';}else if(fdata[i]['size']==1){
		f='('+l[lang]['阅后即焚']+')';
		
		}else{
			f='';
			}
	
li.className = 'msg-item msg-item-self';
	  li.innerHTML = '<i class="msg-user mui-icon mui-icon-person"></i><div class="msg-content"><div class="msg-content-inner">'+fdata[i]['content']+f+'<p>'+fdata[i]['time']+'</p></div><div class="msg-content-arrow"></div></div><div class="mui-item-clear"></div>';
}else{
	
	if(fdata[i]['size']==2){f='('+l[lang]['加密发送']+')';}else if(fdata[i]['size']==1){
	f='('+l[lang]['阅后即焚']+')';
		
		}else{
			f='';
			}
				if(fdata[i]['size']==4){
					fdata[i]['content']=l[fdata[i]['content']];
					}
			
			
	if(fdata[i]['size']>0){
		g=' data-szie="'+fdata[i]['size']+'" data-content="'+fdata[i]['content']+'"'
		
		}else{
			
			g='';
			}
      li.className = 'msg-item';
	  li.innerHTML = '<img class="msg-user-img" src="'+ava+'" /><div class="msg-content"><div class="msg-content-inner" '+g+'>'+fdata[i]['content']+f+'<p>'+fdata[i]['time']+'</p></div><div class="msg-content-arrow"></div></div><div class="mui-item-clear"></div>';	  
	  }
    table.insertBefore(li, table.firstChild);
}

});
get_to_b();
	}



(function($){
 $.ready(function() {
				  
				  
				  
				  
 $("#myfriend").on('tap','.mui-table-view-cell',function(){
uid = this.getAttribute("data-uid");
user = this.getAttribute("data-user");
ava = this.getAttribute("data-ava");
setchat();
offCanvasWrapper.offCanvas('close');
});	
 getyhjh=function(self,content,id,pw){
	 if(content==''){mui.alert(l[lang]['空']);return false;}
setTimeout(mui.post(www+'open/send_yhjh',{size:id,content:content,YSV8_HEX:ysv8hex,pw:pw},function(fdata){
if(typeof(value)=="undefined" && fdata['error']){muialert(fdata); return false;}
 self.innerText=fdata['info'];
 self.setAttribute("data-szie",0);
 self.setAttribute("data-content",'null');
}),500);
	 
	 
	 }
get_to_b=function(){
	setTimeout(function(){var div = document.getElementById('msg-list');div.scrollTop = div.scrollHeight;},500);
	
	}
sendmsg=function(id,uid,content,pw){
	if(content==''){mui.alert(l[lang]['空']);return false;}
setTimeout(mui.post(www+'Friend/send_chat.api',{size:id,uid:uid,content:content,YSV8_HEX:ysv8hex,pw:pw},function(fdata){
//console.log(fdata);
 if(!fdata['error']){muialert(fdata); return false;}

 var li = document.createElement('div');
 li.className = 'msg-item msg-item-self';
	  li.innerHTML = '<i class="msg-user mui-icon mui-icon-person"></i><div class="msg-content"><div class="msg-content-inner">'+document.getElementById('msg-text').value+f+'<p>'+l[lang]['刚刚']+'</p></div><div class="msg-content-arrow"></div></div><div class="mui-item-clear"></div>';
	  table.appendChild(li);
 document.getElementById('msg-text').value='';
 
get_to_b();
 
 
}),500);
}


$("#msg-list").on('tap', '.msg-content-inner',
function() {
	self=this;
id = this.getAttribute("data-szie");
content=this.getAttribute("data-content");
if(id ==2){					
swal({
title: l[lang]['密码'],
text: l[lang]['输入'],
type: "input",
inputType: "password",
showCancelButton: true,
closeOnConfirm: false,
animation: "slide-from-top",
confirmButtonText: l[lang]['确认'],
cancelButtonText:l[lang]['取消'],
inputPlaceholder: l[lang]['密码']
},
function(inputValue){
if (inputValue === false) return false; 
if (inputValue === "") {
swal.showInputError(l[lang]['输入']);
return false;}
pw=inputValue
swal.close();
setTimeout(getyhjh(self,content,id,pw),500);

});
}else if(id ==1){
setTimeout(getyhjh(self,content,id,pw),500);
	
	}else {
	
	
		}
				
            
			
        });



 $("footer").on('tap', 'span',
        function() {
            id = this.getAttribute("data-id");
			if(uid>0){
				if(id ==2){
					
swal({
title: l[lang]['密码'],
text: l[lang]['输入'],
type: "input",
inputType: "password",
showCancelButton: true,
closeOnConfirm: false,
animation: "slide-from-top",
confirmButtonText: l[lang]['确认'],
cancelButtonText:l[lang]['取消'],
inputPlaceholder: l[lang]['密码']
},
function(inputValue){
if (inputValue === false) return false; 
if (inputValue === "") {
swal.showInputError(l[lang]['输入']);
return false;}
pw=inputValue
swal.close();
setTimeout(sendmsg(id,uid,document.getElementById('msg-text').value,pw),500);

});
}else if(id=='clear'){
mui.post(www+'ajax/clear_mess.api',{uid:uid,YSV8_HEX:ysv8hex},function(fdata){
if(fdata['error']){muialert(fdata); return false;}
mui.alert(fdata['info']);
});
}else{
setTimeout(sendmsg(id,uid,document.getElementById('msg-text').value,pw),500);
	
	}
				
            
			}else{
				
				offCanvasWrapper.offCanvas('show');
				}
        });
setTimeout(function(){if(uid){setchat();}else{offCanvasWrapper.offCanvas('show');}},500);
 setTimeout(function(){
 $.post(www+'Friend/friend_list.api',{YSV8_HEX:ysv8hex},function(fdata){
 data=fdata;
 if(typeof(value)=="undefined" && data['error']){muialert(data); return false;}
var table = document.body.querySelector('#myfriend');
for(i  in data){ 
 var li = document.createElement('div');
      li.className = 'mui-table-view-cell';
	  li.setAttribute('data-uid',data[i]['uid']);
	  li.setAttribute('data-user',data[i]['user']);
li.setAttribute('data-ava',data[i]['avatar']+'_50');
	  if(data[i]['c']>0){
c=' <span class="mui-badge mui-badge-danger">'+data[i]['c']+'</span>';
}else{ c='';}

 if(data[i]['state']==3){
state='mui-icon mui-icon-plusempty';
}else if(data[i]['state']==0){ state='mui-icon mui-icon-help';}else{state='mui-icon mui-icon-checkmarkempty';}

	  
      li.innerHTML = '<img class="mui-media-object mui-pull-left" src="'+data[i]['avatar']+'_50" style="border-radius:30px; margin:5px;">'+data[i]['user']+'<span class="'+state+'"></span><p>'+data[i]['ps']+'</p>'+c;
if(data[i]['c']>0){
table.insertBefore(li, table.firstChild);}else{
      table.appendChild(li);
	  }
}


 });
}); },1000);
 
 
})(mui);    