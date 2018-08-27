<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class My extends Ysv8 {
public $menu_action;
public function __construct(){
parent::__construct();
$this->menu_action = array('index'=>'','thread'=>'','post'=>'','mess'=>'','op'=>'','file'=>'','log'=>'','pic'=>'');
}
    public function _no(){
$username   = isset($_GET['YS_URL'][1])?$_GET['YS_URL'][1]:'';
$method     = isset($_GET['YS_URL'][2])?$_GET['YS_URL'][2]:'index';
$pageid      =isset($_GET['YS_URL'][3])?intval($_GET['YS_URL'][3]) : 0;
$username = urldecode ($username); 
if(empty($username)) return $this->message(fy('无输入'));
$encode = mb_detect_encoding($username, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
$username = mb_convert_encoding($username, 'UTF-8', $encode);
$User = M("User"); 
 if(!$data = $User->user_read($username,$this->CacheObj))  return $this->message(fy('用户不存在'));
 if(mt_rand(5,25)==20) $User->up_so($data,$this->CacheObj);/*随机更新*/
$this->menu_action[$method] = 'active';
$this->v('menu_action',$this->menu_action);
 $this->v('data',$data);
  $this->v('method',$method);
 switch ($method){

case 'index':
$thread_data = M('Thread')->read_list($pageid,10,0,-1,$data['id'],$this->CacheObj);
$this->v("thread_data",$thread_data);
$this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'.html',
'm_key'=>$data['user'].','.fy('主页'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'.html',
'title'=>$data['user'].'_'.fy('主页'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));
$this->display('user_index');
		   
		 break;  
case 'thread':
		
$thread_data = M('Thread')->read_list($pageid,10,0,-1,$data['id'],$this->CacheObj);
$this->v("thread_data",$thread_data);
$this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/thread.html',
'm_key'=>$data['user'].','.fy('文章'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/thread.html',
'title'=>$data['user'].'_'.fy('文章'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));
$this->display('user_index');
      break;  
case 'post':                


$this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/post.html',
'm_key'=>$data['user'].','.fy('评论'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/post.html',
'title'=>$data['user'].'_'.fy('评论'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));

            $this->v('post_data',M("Comment")->read_list($pageid, $data['id'],$this->conf['listnum'], 'uid',$this->CacheObj));
            $this->v('data',$data);
            $this->display('user_post');
        
        break;  
case 'op':                
      
	  
	  $this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/op.html',
'm_key'=>$data['user'].','.fy('资料'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/op.html',
'title'=>$data['user'].'_'.fy('资料'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));
	  
             $this->v('data',$data);
            $this->display('user_op');

   break;  
case 'file':        
           
$this->v('filelist',M('File')->read_list($pageid , $this->conf['listnum'],0,-1,$data['id'],$this->CacheObj));
		   
		   
	  $this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/file.html',
'm_key'=>$data['user'].','.fy('文件'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/file.html',
'title'=>$data['user'].'_'.fy('文件'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));       $this->v('data',$data);
            $this->display('user_file');
    break;  
case 'pic':                
$this->v('piclist',M('Pic')->read_list($pageid , $this->conf['listnum'],0,-1,$data['id'],$this->CacheObj));
		   
		   
	  $this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/file.html',
'm_key'=>$data['user'].','.fy('图片'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/file.html',
'title'=>$data['user'].'_'.fy('图片'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));       $this->v('data',$data);
            $this->display('user_pic');
   break;  
case 'log':
          
		   $this->setmate(array('dname'=>$data['user'],
'urlhz'=>'/u/'.urlencode($data['user']).'/log.html',
'm_key'=>$data['user'].','.fy('日志'),
'm_ca'=>'//'.$data['lang'].'.ysv8.com/u/'.urlencode($data['user']).'/log.html',
'title'=>$data['user'].'_'.fy('日志'),
'm_img'=>bucketcdn.$data['avatar'],
'atime'=>$data['atime'],
'author'=>$data['user'],
'name'=>$data['user'],
));
		  
            $this->display('user_log');
}
        

    }
    }
