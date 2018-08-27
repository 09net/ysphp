<?php
namespace Lib;
class Usergroup{
    public function read($id,$type='post'){
	switch ($type){
case 'post':/*发帖*/
if($id>3) return true; else return false; 
  break;  
case 'com':/*评论*/
 if($id>2) return true; else return false; 
  break;
  case 'chat':/*聊天*/
 if($id>1) return true; else return false; 
  break;
   case 'edit':/*修改管理*/
 if($id>7) return true; else return false; 
  break;
   case 'del':/*删除*/
 if($id>8) return true; else return false; 
  break;
     case 'upload':/*删除*/
 if($id>1) return true; else return false; 
  break;
  
default:
 
}
	
	
	
    }
}