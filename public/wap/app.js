(function($){var _this=$.ys={};_this.ys_back=null;_this.pop=false;_this.canhide=false;_this.canvas=false;$.ys.overflow_hide=function(){$("body").attr('hide_size',parseInt($("body").attr('hide_size'))+1);var scrollTop=$("body").scrollTop();$("body").css({'overflow':'hidden','position':'fixed','top':scrollTop*-1});$("body").addClass("ys-body-overflow");}
$.ys.overflow_show=function(){var i=parseInt($("body").attr('hide_size'))-1;$("body").attr('hide_size',(i<0)?0:i);if(parseInt($("body").attr('hide_size'))<1){var sc=$("body").css('top');$("body").css({'overflow':'auto','position':'static','top':'auto'});$("body").scrollTop(Math.abs(parseInt(sc)));$("body").removeClass("ys-body-overflow");}}
$.ys.add_back=function(pos,test){_this.overflow_hide();_this.ys_back=$('<div class="ys-back"></div>');if(_this.canvas){$(".ys-popover-bottom").hide();$("body").removeClass("ys-canvas-body");}
_this.ys_back.click(function(){_this.ys_back.removeClass("in");if(_this.canvas)
_this.canvas_hide(pos);if(_this.pop)
_this.popover_bottom_hide();})
$("body").append(_this.ys_back);setTimeout(function(){_this.ys_back.addClass("in");},1);}
$.ys.canvas_show=function(pos){_this.canvas=true;_this.canhide=true;$(".ys-canvas-"+pos).addClass("ys-canvas-"+pos+"-show");_this.add_back(pos);setTimeout(function(){_this.canhide=false;},1000);};$.ys.canvas_show1=function(pos){_this.canvas=true;$(".ys-canvas-"+pos).addClass("ys-canvas-"+pos+"-show");$("body").addClass("ys-canvas-body-"+pos);_this.add_back(pos);};$.ys.canvas_hide=function(pos){if(_this.canhide){return false;}
$(".ys-canvas-"+pos).removeClass("ys-canvas-"+pos+"-show");$("body").addClass("ys-canvas-body");$("body").removeClass("ys-canvas-body-"+pos);setTimeout(function(){_this.ys_back.remove();$(".ys-popover-bottom").show();_this.canvas=false;},300);_this.overflow_show();};$.ys.popover_bottom_show=function(){_this.pop=true;_this.canvas=false;if($(".ys-popover-bottom").is(":hidden")){$(".ys-popover-bottom").show();}
_this.ys_back=$('<div class="ys-back"></div>');$("body").attr('hide_size',parseInt($("body").attr('hide_size'))+1);_this.ys_back.click(function(){_this.ys_back.removeClass("in");_this.popover_bottom_hide();});$(".ys-popover-bottom").addClass("ys-popover-bottom-show").after(_this.ys_back);setTimeout(function(){_this.ys_back.addClass("in");},1);}
$.ys.popover_bottom_hide=function(){$(".ys-popover-bottom").removeClass("ys-popover-bottom-show");setTimeout(function(){_this.ys_back.remove();_this.pop=false;},300);_this.overflow_show();}
$.ys.warning=function(mess){$(".ys-mess-box").remove();var div=$('<div class="ys-mess-box" onclick="$(this).remove()"><div style="text-align: center;"><a style="margin-top:-100" onclick="$(this).parent().parent().remove()"><span class="icon icon-notification"></span>'+mess+'</a></div></div>');var a=div.find("a");$("body").append(div);a.css('margin-top',($(window).height()-a.innerHeight())/2);}
$.ys.create_iframe=function(pos,id){var obj=$('<div id="'+id+'" class="ys-iframe ys-iframe-'+pos+'"></div>');$("body").append(obj);return obj;}
$.ys.show_iframe=function(obj){$.ys.overflow_hide();setTimeout(function(){obj.addClass("ys-iframe-a");setTimeout(function(){obj.addClass("ys-iframe-b");},500);},100);}
$.ys.hide_iframe=function(obj){obj.removeClass("ys-iframe-a")}})(jQuery);

$(function(){function iframe_forum_size(){$(".iframe_forum").height($(window).height()-$("#iframe-forum-top").height()-40);}
iframe_forum_size();$(window).resize(iframe_forum_size);
});

function open_thread(url){
window.location.href = url;
}
function open_post_box(obj){
	
	$(".post-box").addClass("post-box-a");
	$(obj).after('<div class="ys-back" onclick="hide_post_box(this)"></div>').addClass("ys-body-overflow");
	$("body").attr('hide_size',parseInt($("body").attr('hide_size'))+1 );
	setTimeout(function(){$(".ys-back").addClass('in');},1);

}
function hide_post_box(obj){
	if(obj == undefined)
		obj = '.ys-back';
	$(".post-box").removeClass("post-box-a");
	$.ys.overflow_show();
	$(".ys-back").removeClass('in');
	setTimeout(function(){
		$(obj).remove();
	},300);
	
}
function hide_lt(uid){
	 var i = parseInt($("body").attr('hide_size'))-1;
		$("body").attr('hide_size', (i<0)?0:i );
	$.ys.hide_iframe($('#lt-'+uid));
}
//点击好友 打开聊天窗口
function open_lt(username,uid,avatar){

	$("#friend-span-"+uid).removeClass("friend-show").addClass("friend-hide");

	var v = parseInt($(".xx").text()) - parseInt($("#friend-span-"+uid).text());

	$(".xx").text(v);
	if(v<1){
		$('.xx').hide();
		$(".xx").text('0')
	}


	var _this = $('#lt-'+uid);
	if(_this.length == 0){
		var obj = $.ys.create_iframe('right','lt-'+uid);
		$.ys.show_iframe(obj);
		var box = $('<div style="background: #f1f4f9;width:100%;height:100%"><header class="ys-header ys-bo-b"><a class="ys-header-nav ys-header-left fa fa-chevron-left" onclick="hide_lt('+uid+')"></a><h1 class="ys-header-title">'+username+'</h1><a class="ys-header-nav ys-header-right" onclick=""></a></header></div>');
		obj.append(box);
		box.append('<div class="mui-content" id="is-obj-'+uid+'"><div id="msg-list" class="is-'+uid+'"><div class="lt-id-'+uid+'" user="'+username+'" avatar="'+avatar+'"></div></div></div>');
		

		box.append('<footer class="footer-lt"><div class="footer-center"><textarea id="msg-text" type="text" class="input-text lt-text-'+uid+'"></textarea></duv><div class="footer-right"><button onclick="send_lt('+uid+',this)" class="ys-btn ys-btn-primary" type="button" style="height:36px">Send</button></div></footer>');


		get_old_chat(uid,username,avatar);
		
	
		
		return;
	}
	$.ys.show_iframe(_this);
	
	


}

function send_lt(uid,obj){
    if($(".lt-text-"+uid).val()=='')
        return $.ys.warning('内容不能为空!');

    $(".lt-text-"+uid).attr('disabled','disabled');
    $(obj).attr('disabled','disabled');
    $.ajax({
        url: www + 'friend' + exp + 'send_chat',
        data: {content : $(".lt-text-"+uid).val(), uid:uid},
        type:'post',
        dataType:'json',
        success:function(e){
            if(!e.error){
                $.ys.warning(e.info);
                $(obj).removeAttr('disabled');
                $(".lt-text-"+uid).removeAttr('disabled');
                return ;
            }
            add_lt(uid,'msg-item-self',window.ys_user,$(".lt-text-"+uid).val(),new Date().getHours() + ":"+ new Date().getMinutes() +":"+ new Date().getSeconds() ,window.ys_avatar);
            $(".lt-text-"+uid).val('');
            $(".lt-text-"+uid).removeAttr('disabled');
            $(obj).removeAttr('disabled');
            $(".lt-text-"+uid).focus();
            $(".is-"+uid).scrollTop(99999);

        },
        error:function(){
            $(".lt-text-"+uid).removeAttr('disabled');
            $(obj).removeAttr('disabled');
        }
    })
}

var friend_box = false;
var friend_obj = null;
function hide_friend_box(){
	$.ys.overflow_show();

	if(friend_obj != null){
		$.ys.hide_iframe(friend_obj);
	}
}
function tog_friend_box(){
	var scrollTop = $("body").scrollTop();
	

	//$.ys.overflow_hide();
	$("#ys-mess").text("");

	
	if(friend_obj == null){
		friend_obj = $.ys.create_iframe('right');

		$.ys.show_iframe(friend_obj);
		var box = $('<div style="background: #f1f4f9;width:100%;height:100%"><header class="ys-header ys-bo-b"><a class="ys-header-nav ys-header-left fa fa-chevron-left" onclick="hide_friend_box()"></a><h1 class="ys-header-title" id="fr-head">联系人</h1><a class="ys-header-nav ys-header-right" onclick=""><span class=fa fa-address-book-o xx">0</span></a></header></div>');
		friend_obj.append(box);
		box.append('<div id="friend-tab" class="ys-cent-list"><ul><li class="a"><a data="1" href="javascript:void(0);">关注</a></li><li><a data="3" href="javascript:void(0);">粉丝</a></li><li><a data="0" href="javascript:void(0);">陌生人</a></li></ul></div>');
		box.append('<div id="friend-1" class="friend-list ys-list ys-bo-t ys-bo-b"><div></div></div>');
		box.append('<div id="friend-3" style="display:none" class="friend-list ys-list ys-bo-t ys-bo-b"><div></div></div>');
		box.append('<div id="friend-0" style="display:none" class="friend-list ys-list ys-bo-t ys-bo-b"><div></div></div>');


		setTimeout(function(){
			$("#friend-tab a").click(function(){
				$("#friend-tab li").removeClass('a');
				$(this).parent().addClass('a');
				$(".friend-list").hide();
				$('#friend-'+$(this).attr('data')).show();

			});
		},500);

		$.ajax({
	        url : '/Friend/friend_list',
	        type:'post',
	        dataType:'json',
	        success:function(e){
	            var html2 ='';
	            var html3 ='';
	            var html0 = '';
	            for(o in e){
	            	$(".xx").text(parseInt($(".xx").text()) + parseInt(e[o].c));
	            	if(e[o].c != 0)
	            		$(".xx").show();

	            	var time1 = new Date(parseInt(e[o].atime)*1000);
	            	var time = time1.getTime();
	            	var date=new Date();
					date.setHours(0);
					date.setMinutes(0);
					date.setSeconds(0);
					date.setMilliseconds(0);

					var time2=date.getTime();

					if(time < time2){ //非今天
						time = '16/'+time1.getMonth()+"/"+time1.getDate();
					}else{
						time = time1.getHours()+":"+time1.getMinutes();
					}
					if(e[o].atime =='0')
						time='';

	            	
	                if(e[o].state==0){
	                    html0 += '<a  href="javascript:void(0)" onclick="open_lt(\''+e[o].user+'\','+e[o].uid+',\''+e[o].avatar+'\')"><img class="ys-ty right-10 " width="40" height="40" src="'+e[o].avatar+'"></span><span class="title friend-name">'+e[o].user+'</span><span id="friend-ps-'+e[o].uid+'" class="friend-ms">'+((e[o].ps==null)?'':e[o].ps)+'</span><span class="friend-xx ys-lable ys-lable-danger friend-'+(e[o].c=='0' ? 'hide' : 'show')+'" id="friend-span-'+e[o].uid+'">'+e[o].c+'</span><span class="friend-time">'+time+'</span></a>';
	                }else if(e[o].state==1 || e[o].state==2){
	                    html2 += '<a  href="javascript:void(0)" onclick="open_lt(\''+e[o].user+'\','+e[o].uid+',\''+e[o].avatar+'\')"><img class="ys-ty right-10 " width="40" height="40" src="'+e[o].avatar+'"></span><span class="title friend-name">'+e[o].user+'</span><span id="friend-ps-'+e[o].uid+'" class="friend-ms">'+((e[o].ps==null)?'':e[o].ps)+'</span><span class="friend-xx ys-lable ys-lable-danger friend-'+(e[o].c=='0' ? 'hide' : 'show')+'" id="friend-span-'+e[o].uid+'">'+e[o].c+'</span><span class="friend-time">'+time+'</span></a>';
	                }else if(e[o].state==3){
	                    html3 += '<a  href="javascript:void(0)" onclick="open_lt(\''+e[o].user+'\','+e[o].uid+',\''+e[o].avatar+'\')"><img class="ys-ty right-10 " width="40" height="40" src="'+e[o].avatar+'"></span><span class="title friend-name">'+e[o].user+'</span><span id="friend-ps-'+e[o].uid+'" class="friend-ms">'+((e[o].ps==null)?'':e[o].ps)+'</span><span class="friend-xx ys-lable ys-lable-danger friend-'+(e[o].c=='0' ? 'hide' : 'show')+'" id="friend-span-'+e[o].uid+'">'+e[o].c+'</span><span class="friend-time">'+time+'</span></a>';
	                }
	                
	                        
	            }
	            
	            $("#friend-1 div").append(html2);
	         
	           

	            $("#friend-3 div").append(html3);
	            $("#friend-0 div").append(html0);

	            

	            $("#friend-1 div").prepend('<a  href="javascript:void(0)" onclick="open_lt(\'系统消息\',0,\''+bucketcdn+'bell.png\')"><img class="ys-ty right-10" width="40" height="40" src="'+bucketcdn+'bell.png"></span><span class="title friend-name">系统消息</span><span id="friend-ps-0" class="friend-ms">没有新消息</span><span class="friend-xx ys-lable ys-lable-danger friend-hide" id="friend-span-0">0</span></a>');
	            window.friend_pm = 0;
	            setInterval(function(){
	                $.ajax({
	                    url:'/Friend/pm',
	                    type:'post',
	                    dataType:'json',
	                    data:{
	                        time:window.friend_pm
	                    },
	                    success:function(e){
	                        window.friend_pm = e.atime;
	                        if(e.error){
	                            var size =0;
	                            for(o in e.info.reverse()){
	                            	//判断聊天框是否打开 
	                                if(!$('.lt-id-'+e.info[o].uid2).length){ //未打开
	                                    if(!$('#friend-span-'+e.info[o].uid2).length){ //朋友列表不存在该用户
	                                        add_friend_li(e.info[o].uid2);//添加好友信息到好友列表
	                                    }
	                                    else{
	                                        $('#friend-span-'+e.info[o].uid2).removeClass('friend-hide').addClass('friend-show').text(e.info[o].c);
	                                        var obj = $('#friend-span-'+e.info[o].uid2).parent();
	                                        var html = obj.prop("outerHTML");
	                                        obj.parent().prepend(html);
	                                        obj.remove();
	                                    }
	                                }
	                                else{ //打开聊天框
	                                    var obj = $('.lt-id-'+e.info[o].uid2);
	                                    //判断是否已经创建
	                                    if(!obj.parent().parent().parent().hasClass('ys-iframe-a')){ 
		                                    
		                                    $('#friend-span-'+e.info[o].uid2).removeClass('friend-hide').addClass('friend-show').text(e.info[o].c);

		                                    var obj1 = $('#friend-span-'+e.info[o].uid2).parent();
	                                        var html = obj1.prop("outerHTML");
	                                        obj1.parent().prepend(html);
	                                        obj1.remove();


	                                    }

	                                    get_old_chat(e.info[o].uid2,obj.attr('user'),obj.attr('avatar'));

	                                    
	                                }
	                                size+=parseInt(e.info[o].c);
	                                
	                            }
	                            if(size != 0 ){
	                                $(".xx").show().text(size);
	                                $("#ys-mess").html('(<em class="ys-font-warning">'+size+'</em>)');
	                            }
	                        }
	                        
	                    },error:function(){

	                    }
	                })
	            },2000);

	           

	            
	        },
	        error:function(){

	        }
	    })
	    return;
	}
	$("#fr-head").text("联系人");

	$.ys.show_iframe(friend_obj);
	

}
function add_lt(id,pos,user,content,time,avatar){
    var c_obj = $(".lt-id-"+id);
	
    var html = '<div class="msg-item '+pos+'">'+'<img class="msg-user-img msg-user" src="'+avatar+'" alt=""><div class="msg-content"><div class="chat-body clearfix"><div class="msg-content-inner">'+ content+'</div><div class="msg-content-arrow"></div></div><div class="mui-item-clear"></div></div>';
    
    c_obj.append(html);
    c_obj.scrollTop(9999);
	
	
    
	

}

function get_old_chat(uid,user,avatar){
    $.ajax({
        url:'/Friend/get_old_chat',
        data:{uid:uid},
        type:'post',
        dataType:'json',
        success:function(e){
			
            for(o in e.reverse()){

                if(e[o].uid1 == uid){
                    add_lt(uid,'msg-item-self',window.ys_user,e[o].content,e[o].time,window.ys_avatar);
                }
                else{
                    add_lt(uid,'',user,e[o].content,e[o].time,avatar);
                    if(uid == 0){
                    	e[o].content = e[o].content.replace(/<[^>]+>/g,"");
                    }
                    $("#friend-ps-"+uid).text(e[o].content);
                }


                
            }
            
            $(".is-"+uid).scrollTop(99999);
        }
        ,error: function(){

        }
    });
}

function add_friend_li(uid){
    $.ajax({
        url:'/Friend/user_info',
        type:'post',
        data:{uid:uid},
        dataType:'json',
        success:function(e){
            if(e.error){
                var html = '<a href="javascript:void(0)" onclick="open_lt(\''+e.info.user+'\','+uid+',\''+e.info.avatar+'\')"><img class="ys-ty right-10" width="40" height="40" src="'+e.info.avatar+'"></span><span class="title">'+e.info.user+'</span><span class="ys-lable ys-lable-danger friend-show" id="friend-span-'+uid+'"  id="friend-span-'+uid+'">..</span></a>';



                $("#friend-0").prepend(html);
            }
        }
    })
}
function friend(uid,obj){
    friend_state(uid,function(b,m){
        var _obj = $(obj);
        if(m){
            _obj.removeClass("ys-btn-primary");
            _obj.addClass("ys-btn-danger");
            _obj.text("取消关注");
        }
        else{
            _obj.removeClass("ys-btn-danger");
            _obj.addClass("ys-btn-primary");
            _obj.text("关注");
        }
    })
}

function url_back(test){
 if(document.referrer.search(www) == -1 || document.referrer == '' || document.referrer.search("/post") != -1 || document.referrer.search("/user") != -1){
  if(typeof(test)=='string'){window.location.href=test;}else{ window.location.href=www;}
 }else{
history.back(-1);
}
}


window.iframe_size = 0;
window.now_href1 = window.location.href;
$(document).ready(function(){  
	window.addEventListener("popstate",function(event){
		
		if(now_href1 == window.location.href && iframe_size == 0)
			return;
		if(window.iframe_size >0){
			
			var i = window.iframe_size--;
		
			if(i==1){
				$.ys.overflow_show();
			}
			$("#ys-iframe-box-"+(i)).removeClass("ys-iframe-a");
			setTimeout(function(){
				$("#ys-iframe-box-"+(i)).remove();
			},500);
			return;
		}

		
		window.location.reload()

    });
});
var touchmove_handler = function (e) {
        e.preventDefault();
    };
    window.href_top = document.referrer;
function ajax_click(){
		
		var _this = $(this);
		var href = _this.attr('href');
		var now_href=window.location.href;
		window.href_top = now_href;
		var pos = _this.attr('pos');
		var hide_menu = _this.attr('hide_menu');
		if(pos != ''){
			var iframe = _this.attr('iframe');
			
			if(iframe=='undefined')
				iframe='';
			
			if(hide_menu =='true'){
				$.ys.canvas_hide('left');
			}
			if(iframe == 'true'){
				$(".body").html('<img src="'+bucketcdn+'loading.gif" style="width: 100%;">');
			}else{
				var obj = $.ys.create_iframe(pos,"ys-iframe-box-"+(++window.iframe_size));
				obj.html('<header class="ys-header ys-fix-t"><a href="javascript:history.back(-1)" class="ys-header-nav ys-header-left fa fa-chevron-left" ></a><h1 class="ys-header-title">...</h1></header>');
				obj.append('<div class="body"><img src="'+bucketcdn+'loading.gif" style="width: 100%;"></div>');
				var rgb = _this.attr('rgb');
				
				if(rgb != '')
					obj.css('background',rgb);
				$.ys.show_iframe(obj);
			}
			
			
			$.ajax({
				url:href,
				type:'get',
				dataType:'html',
				success:function(data){
					$.ajaxSetup({ cache: true });
					if(iframe == 'true'){
						
						$(".body").html(data.match(/<section class="body".*?>([\s\S]*?)<\/section>/)[1]);
						$(".body a[ajax=true]").click(ajax_click);
						$(".ys-header-title").html(data.match(/<h1 class="ys-header-title".*?>([\s\S]*?)<\/h1>/)[1]);
					}else{
						setTimeout(function(){
							obj.html(data.match(/<body.*?>([\s\S]*?)<\/body>/)[1]);
							obj.find('a[ajax=true]').click(ajax_click);
						},400);
					}
            		$("title").text(data.match(/<title>([\s\S]*?)<\/title>/)[1]);
            		
				},
				error:function(){}
			});
			
			
			window.history.pushState("","",href);
		}
		return false;
	 }

