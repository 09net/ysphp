(function(A){var _="maxWidth"in document.documentElement.style,$=!-[1,]&&!("prototype"in Image)&&_;A.fn.autoIMG=function(){var $=this.width();return this.find("img").each(function(D,A){if(_)return A.style.maxWidth=$+"px";var C=A.src;A.style.display="none";A.removeAttribute("src");B(C,function(B,_){if(B>$){_=$/B*_,B=$;A.style.width=B+"px";A.style.height=_+"px"}A.style.display="";A.setAttribute("src",C)})})};$&&(function(A,$,_){_=$.createElement("style");$.getElementsByTagName("head")[0].appendChild(_);_.styleSheet&&(_.styleSheet.cssText+=A)||_.appendChild($.createTextNode(A))})("img {-ms-interpolation-mode:bicubic}",document);var B=(function(){var B=[],A=null,_=function(){var _=0;for(;_<B.length;_++)B[_].end?B.splice(_--,1):B[_]();!B.length&&$()},$=function(){clearInterval(A);A=null};return function(K,J,I,E){var D,F,C,H,$,G=new Image();G.src=K;if(G.complete){J(G.width,G.height);I&&I(G.width,G.height);return}F=G.width;C=G.height;D=function(){H=G.width;$=G.height;if(H!==F||$!==C||H*$>1024){J(H,$);D.end=true}};D();G.onerror=function(){E&&E();D.end=true;G=G.onload=G.onerror=null};G.onload=function(){I&&I(G.width,G.height);!D.end&&D();G=G.onload=G.onerror=null};if(!D.end){B.push(D);if(A===null)A=setInterval(_,40)}}})()})(jQuery)