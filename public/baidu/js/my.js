var ipt = document.getElementById("ipt");
var ser = document.getElementById("ser_box");
var bot = document.getElementById("bot_box");
var oul = document.getElementById("oul");
ipt.oninput = function() {
 var ss = encodeURIComponent(ipt.value);
 var url = "https://i.44api.com/basetable/sg/" + ss;
 addScript(url);
}
ipt.onfocus = function() {
 var ss = encodeURIComponent(ipt.value);
 var url = "https://i.44api.com/basetable/sg/" + ss;
 addScript(url);

}
function queryList(data) {
 ss=document.getElementById("sssg");
 document.body.removeChild(ss)
 var arr = data.s;
 oul.innerHTML = "";
 if(arr.length == 0) {
 bot.style.display = "none";
 } else {
 bot.style.display = "block";
 }

 for(var i = 0; i < arr.length; i++) {
 li = document.createElement("li");
 li.innerHTML = arr[i];
 li.onclick = function() {
 oul.innerHTML = "";
 ipt.value = this.innerHTML;
 bot.style.display = "none";
 }
 oul.appendChild(li);
 }
}

function addScript(url) {
 var s = document.createElement("script");
 s.src = url;
 s.id = 'sssg';
 s.type = "text/javascript";
 document.body.appendChild(s);
}
lis = document.getElementsByTagName("li");
/*按键*/
var i = 0;
document.onkeydown = function(ev) {
 if(bot.style.display == "block") {
 if(ev.keyCode == 40) {
 for(var j = 0; j < lis.length; j++) {
 if(lis[j].className == "sel") {
 lis[j].className = "";
 }
 }

 if(i < lis.length) {
 lis[i].className = "sel";
 i++;
 if(i == lis.length) {
 i = 0;
 }
 }
 }

 if(ev.keyCode == 38) {
 m = 0
 for(; m < lis.length; m++) {
 if(lis[m].className == "sel") {
 lis[m].className = "";
 break;
 }
 }
 i = m;
 if(m > 0) {
 lis[m - 1].className = "sel";
 } else {
 lis[lis.length - 1].className = "sel";
 }
 }

 
 
 
 if(ev.keyCode == 13) {
 for(var n = 0; n < lis.length; n++) {
 if(lis[n].className == "sel") {
 ipt.value = lis[n].innerHTML;
 }
 }
 bot.style.display = "none";
 }
 } else {
 i = 0;
 m = 0;
 }
}