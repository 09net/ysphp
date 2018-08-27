var initPhotoSwipeFromDOM = function(gallerySelector) {
var parseThumbnailElements = function(el) {
var thumbElements = el.getElementsByTagName("img"),numNodes = thumbElements.length,items = [],figureEl,linkEl,size,item;width=800,height=600
for (var i = 0; i < numNodes; i++) {
figureEl = thumbElements[i];
if (figureEl.nodeType !== 1) {continue;}
if(figureEl.hasAttribute('width') && figureEl.hasAttribute('height')){
width=figureEl.getAttribute('width');
height=figureEl.getAttribute('height');
}else{
if(figureEl.getAttribute('data-size')){
size = figureEl.getAttribute('data-size').split('x');
width=size[0];
height=size[1];
}
}
item = {
src: figureEl.getAttribute('src').split('_')[0],
w: parseInt(width, 10),
h: parseInt(height, 10),
msrc: figureEl.getAttribute('src'),
title: figureEl.getAttribute('alt'),
};
item.el = figureEl;
items.push(item);
}
return items;
};
var closest = function closest(el, fn) {
return el && (fn(el) ? el : closest(el.parentNode, fn));
};
var onThumbnailsClick = function(e) {
e = e || window.event;
if(e.target.tagName.toUpperCase()=='A'){window.open(e.target.getAttribute('href'));return false;}
if(e.target.tagName.toUpperCase()!='IMG'){return false;}
e.preventDefault ? e.preventDefault() : e.returnValue = false;
var eTarget = e.target || e.srcElement;
var clickedListItem = closest(eTarget, function(el) {
return (el.tagName && el.tagName.toUpperCase() === 'DIV');
});
if (!clickedListItem) {return;}
var clickedGallery = clickedListItem.parentNode,
childNodes = clickedListItem.parentNode.childNodes,numChildNodes = childNodes.length,nodeIndex = 0,index;
for (var i = 0; i < numChildNodes; i++) {
if (childNodes[i].nodeType !== 1) {
continue;
}
if (childNodes[i] === clickedListItem) {
index = nodeIndex;
break;
}
nodeIndex++;
}


if (index >= 0) {
openPhotoSwipe(index, clickedGallery);
}
return false;
};

var photoswipeParseHash = function() {
var hash = window.location.hash.substring(1),
params = {};

if (hash.length < 5) {
return params;
}

var vars = hash.split('&');
for (var i = 0; i < vars.length; i++) {
if (!vars[i]) {
continue;
}
var pair = vars[i].split('=');
if (pair.length < 2) {
continue;
}
params[pair[0]] = pair[1];
}

if (params.gid) {
params.gid = parseInt(params.gid, 10);
}

return params;
};
var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
var pswpElement = document.querySelectorAll('.pswp')[0],gallery,options,items;
items = parseThumbnailElements(galleryElement);

options = {
galleryUID: galleryElement.getAttribute('data-pswp-uid'),
getThumbBoundsFn: function(index) {
var thumbnail = items[index].el, pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
rect = thumbnail.getBoundingClientRect();

return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
}

};

if (fromURL) {
if (options.galleryPIDs) {
for (var j = 0; j < items.length; j++) {
if (items[j].pid == index) {
options.index = j;
break;
}
}
} else {
options.index = parseInt(index, 10) - 1;
}
} else {
options.index = parseInt(index, 10);
}

if (isNaN(options.index)) {
return;
}

if (disableAnimation) {
options.showAnimationDuration = 0;
}

gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
gallery.init();
};

var galleryElements = document.querySelectorAll(gallerySelector);
for (var i = 0, l = galleryElements.length; i < l; i++) {
galleryElements[i].setAttribute('data-pswp-uid', i + 1);
galleryElements[i].onclick = onThumbnailsClick;
}
var hashData = photoswipeParseHash();
if (hashData.pid && hashData.gid) {
openPhotoSwipe(hashData.pid, galleryElements[ hashData.gid - 1 ], true, true);
}
};
initPhotoSwipeFromDOM('.my-gallery');