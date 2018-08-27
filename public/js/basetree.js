function loadRegion(sel,selName,num,nownum){
$("#"+selName+" option").each(function(){
$(this).remove();});
$('<option value=0>'+langfun('空')+'</option>').appendTo($("#"+selName));
var val = arguments[3] ? arguments[3] :$("#"+sel).val();
$.getJSON(icdn+'qytree/Index/'+val+'.html',{},
function(data){
if(data){
$.each(data,function(idx,item){
if(item.id==num){
$("<option value="+item.id+" selected=\"selected\">"+item.name+"</option>").appendTo($("#"+selName));
}else{
$("<option value="+item.id+">"+item.name+"</option>").appendTo($("#"+selName));
} 
});
}else{
$('<option value=0>'+langfun('空')+'</option>').appendTo($("#"+selName));}
});
}
function loadRegionval(sel,selName,num,nownum){
$("#"+selName+" option").each(function(){
$(this).remove();});
$('<option value=0>'+langfun('空')+'</option>').appendTo($("#"+selName));
var val = arguments[3] ? arguments[3] :$("#"+sel).val();
$.getJSON(icdn+'basetable/Index/'+val+'.html',{},
function(data){
if(data){
$.each(data,function(idx,item){
if(item['val']==num){
$("<option value="+item['val']+" selected=\"selected\">"+item.name+"</option>").appendTo($("#"+selName));
}else{
$("<option value="+item['val']+">"+item.name+"</option>").appendTo($("#"+selName));
} 
});
}else{
$('<option value=0>'+langfun('空')+'</option>').appendTo($("#"+selName));}
});
}