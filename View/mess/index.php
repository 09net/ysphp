<!DOCTYPE html><html lang="{#HTML_LANG}"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><title>{$title}</title>
<script src="{#icdn}public/js/jquery.min.js"></script>
<script src="{#icdn}public/pc/app.js"></script>
<link href="{#icdn}public/font-awesome/font-awesome.min.css" rel="stylesheet">
<link href="{#icdn}public/css/app.css" rel="stylesheet">
<link href="{#icdn}public/pc/app.css" rel="stylesheet">
<link href="{#icdn}public/css/guide.css" rel="stylesheet">
<script src="{#icdn}public/sweetalert/sweet-alert.min.js"></script>
<link href="{#icdn}public/sweetalert/sweetalert.css" rel="stylesheet">
<style>*{
margin:0;padding:0;}
.bj{
position: fixed;top: 0;left: 0;height: 100%;width: 100%;z-index: -10;background: #e5efff;}
*, :after, :before {
box-sizing: border-box;}
</style></head><body><div class="bj"></div></div><script>window.onload = function(){
swal({
title: "{$msg}",
type: "<?php echo ($bool) ? "success" : "error" ?>",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "{$msg}",
cancelButtonText:"{lag 返回}",
}, function(e){
if(e){
window.location.href="{$url}";
}else{
history.go(-1);
}
});
}</script></body></html>