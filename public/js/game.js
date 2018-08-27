var colorArr = ["#096", "green", "pink", "blue", "#369", "purple", "yellow", "#ccc", "#000"];
var flag=false;var btni=0;
var timer=null;
var timerbtn=null;
var str='';
 function btntx(self) {
 btni=0;
 clearInterval(timerbtn);
 
    timerbtn = setInterval(function () {
              
                    self.style.backgroundColor = colorArr[Math.round(Math.random() * 8)];
               btni++;
              if(btni>10)window.setTimeout(function () { clearInterval(timerbtn);       }, 500);
     

            }, 800);
 
 }
 
function mp3play_tts(span){/*播放ttsMP3*/
//twinkel();
btntx(span)
spanstr=span.innerText;
spanstr=spanstr.toLowerCase();
spanstr=spanstr.split('|')[0]
arr= [];
arr[arr.length] ='https://zh.180zhi.com/tts/' + encodeURIComponent(myTrim(spanstr)) + '.mp3';
var myAudio = new Audio(); 
myAudio.preload = true; 
myAudio.controls = true; 
myAudio.src = arr.shift();         //每次读数组最后一个元素 
myAudio.addEventListener('ended', playEndedHandler, false); 
myAudio.play(); 
document.getElementById("bgm").appendChild(myAudio); 
myAudio.loop = false;//禁止循环，否则无法触发ended事件 
function playEndedHandler(){ 
url=arr.shift()
if (typeof(url) == "undefined") {myAudio.removeEventListener('ended',playEndedHandler,false); return false;}
myAudio.src = url; 
myAudio.play(); 
!arr.length && myAudio.removeEventListener('ended',playEndedHandler,false);//只有一个元素时解除绑定 
} 
}
 function twinkel(cubes,maxnum) {
        flag = !flag;// 点击一下开始 再点一下结束
        if (flag) {
            clearInterval(timer);
            timer = setInterval(function () {
                var obj = {};
                for (var i = 0; i < maxnum; i++) {
                    var num = Number(Math.round(Math.random() * (cubes.length-1)));

                    // 对象唯一性进行数字的去重
                    if (typeof obj[num] !== "undefined") {
                        i--;
                        continue;
                    }
                    obj[num] = num;
                    cubes[num].style.backgroundColor = colorArr[Math.round(Math.random() * (colorArr.length-1))];
                }
                window.setTimeout(function () {
                    for (var j = 0, len = cubes.length; j < len; j++) {
                        var cube = cubes[j];
                        cube.style.backgroundColor = "#f40";
                    }
                }, 500);

            }, 1000);
        } else {
            clearInterval(timer);
        }
    }