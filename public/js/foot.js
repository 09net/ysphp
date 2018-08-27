(function(A){var _="maxWidth"in document.documentElement.style,$=!-[1,]&&!("prototype"in Image)&&_;A.fn.autoIMG=function(){var $=this.width();return this.find("img").each(function(D,A){if(_)return A.style.maxWidth=$+"px";var C=A.src;A.style.display="none";A.removeAttribute("src");B(C,function(B,_){if(B>$){_=$/B*_,B=$;A.style.width=B+"px";A.style.height=_+"px"}A.style.display="";A.setAttribute("src",C)})})};$&&(function(A,$,_){_=$.createElement("style");$.getElementsByTagName("head")[0].appendChild(_);_.styleSheet&&(_.styleSheet.cssText+=A)||_.appendChild($.createTextNode(A))})("img {-ms-interpolation-mode:bicubic}",document);var B=(function(){var B=[],A=null,_=function(){var _=0;for(;_<B.length;_++)B[_].end?B.splice(_--,1):B[_]();!B.length&&$()},$=function(){clearInterval(A);A=null};return function(K,J,I,E){var D,F,C,H,$,G=new Image();G.src=K;if(G.complete){J(G.width,G.height);I&&I(G.width,G.height);return}F=G.width;C=G.height;D=function(){H=G.width;$=G.height;if(H!==F||$!==C||H*$>1024){J(H,$);D.end=true}};D();G.onerror=function(){E&&E();D.end=true;G=G.onload=G.onerror=null};G.onload=function(){I&&I(G.width,G.height);!D.end&&D();G=G.onload=G.onerror=null};if(!D.end){B.push(D);if(A===null)A=setInterval(_,40)}}})()})(jQuery)
$(function(){$("#contentfy").autoIMG();}); 
$(document).ready(function(){ 
var range = 250; var elemt = 500; var maxnum = 20; var totalheight = 0; var num=0;var ajaxbool=false
var maincontent = $("#maincontent"); var getmore=$("#getmore")
$(window).scroll(function(){ 
/*自动加载*/ 
if (maincontent.length > 0 && getmore.length > 0) { 
var srollPos = $(window).scrollTop(); 
totalheight = parseFloat($(window).height()) + parseFloat(srollPos); 
if(($(document).height()-range) <= totalheight && num != maxnum) { 
var ajaxurl=getmore.attr("href");

if(ajaxurl.length>4 && ajaxbool==false){
ajaxbool=true
$.ajax({
url: ajaxurl,
type: "GET",
success: function(data){
num++;
var result = $(data);
maincontent.append(result.find("#maincontent").html());
getmore.attr("href",result.find("#getmore").attr("href"));
ajaxbool=false;
}
});
}
}
}
try{
var h = $(window).height();
var top = $(window).scrollTop();
var rFixedBox = $('.rFixedBox').prev().offset();
var fixedTop = rFixedBox.top;
if(top>=fixedTop+50){$('.rFixedBox').css({'position':'fixed','top': 54});}else{$('.rFixedBox').css({'position':'static', 'top':0}); } 
}catch(err){
} 
}); 
	   
if(islogin){/*登录数据处理*/
if($('#f_star').length > 0){
if(JSON.stringify(my_f_state) === '[]'){ /*数组为空，获取*/
}else{
if(in_array_key($("#f_star").data("uid"),my_f_state,'uid2')){$('#f_star').addClass("fa-user-times");$('#f_star').removeClass("fa-user-plus");$('#f_star').css("color","red");
$('#f_star').css("background-color","#FFFFFF");
}else{
	$('#f_star').addClass("fa-user-plus");$('#f_star').removeClass("fa-user-times");
$('#f_star').css("color","");
$('#f_star').css("background-color","");
}
}
}
}

}); 
