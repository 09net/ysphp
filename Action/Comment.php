<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Comment extends Ysv8 {
public $tid=0;
public $pid=0;
public $posts=0;
public $title;
public $content;
public $ante_type=0;
public function __construct() {
parent::__construct();

}

	public function vote(){
	if(!IS_LOGIN) return $this->json(["error"=>true,"info"=>fy('请登录')]);
		$id=intval(X("post.id")); // 提交ID
		$type = X("post.type"); //类型
		if(!in_array($type,['goods','nos'])) return $this->json(["error"=>true,"info"=>fy('类型不对')]);
		
			$Thread = M("Comment");
          if (!$thread_data = $Thread->read($id, $this->CacheObj)) return $this->json(["error"=>true,"info"=>fy('文章已被删除')]);
			if($this->_user['etime']<NOW_TIME-3600){
			if($type=='goods'){
if(mt_rand(20,30)==25)   $Thread->up_int($id, ['goods[+]'=>1,'btime[+]'=>NOW_TIME],$this->CacheObj);  else $Thread->up_int($id, ['goods[+]'=>1,'btime[+]'=>1000],$this->CacheObj);
			}else{
						$Thread->up_int($id, ['nos[+]'=>1,'btime[-]'=>1000],$this->CacheObj);
			}
			
			
			
			 M('User')->up_int(NOW_UID,array('etime'=>NOW_TIME),$this->CacheObj);}
			
return $this->json(["error"=>false,"info"=>fy("投票成功")]);
				

	
	}
 public function more(){
  $pageid=X('post.pageid');
   $comm=M("Comment");
$id = intval(isset($_GET['YS_URL'][2]) ? $_GET['YS_URL'][2] : 0);
   if (!$thread_data = $comm->read($id, $this->CacheObj)) return $this->message(fy('不存在该主题'));  
   $thread_data['title']=mb_substr(trim(strip_tags($thread_data['content'])), 0,60);
    $thread_data['summary']=mb_substr(trim(strip_tags($thread_data['content'])), 0,$this->conf['summary_size']);
  $this->v("thread_data", $thread_data);
  $this->v("PostList", $comm->read_list($pageid, $id,$this->conf['listnum'],'pid', $this->CacheObj));
   $this->setmate(array(
                   'dname' => fy('评论'),
                    'm_des' =>$thread_data['summary'],
                    'title' => fy('评论').' : '.$thread_data['title'],
                    
                ));
   $this->display('com_more');
 }
 public function _no(){
 $id = intval(METHOD_NAME);
 $comm=M("Comment");
 if (!$thread_data = M("Thread")->read($id, $this->CacheObj)) return $this->message(fy('不存在该主题'));
 if(IS_POST and X('post.content')){
 if(!IS_LOGIN){
if(IS_AJAX && IS_POST){die($this->json(array('error'=>false,'info'=>fy('请登录'))));}else{header('location: /user/login');die;}
}
  if(!L("Usergroup")->read($this->_user['group'],'com')) return $this->json(array('error'=>false,'info'=>fy('权限不够')));
$Thread=M("Thread");
$pid=X('post.pid');
    if(!$content =str_replace(bucketcdn,'{m}',htmlspecialchars(X('post.content'))) or mb_strlen($content)<10) return $this->message(fy('内容太少'));
	if(!$hashid=$this->hashid($content))  return $this->message(fy('位置错误'));
  M("Post")->in(array('tid' => 0,'content' => $content,'hashid'=>$hashid),$this->CacheObj);
if($comm->in(array('tid' => $id,'pid' => $pid,'hashid'=>$hashid),$this->CacheObj)){
if($pid>0) $comm->up_int($pid,array('posts[+]'=>1),$this->CacheObj);
   $Thread->up_int($id,array('posts[+]'=>1),$this->CacheObj);
   M('User')->up_int(NOW_UID,array('posts'=>1),$this->CacheObj);
    M('Forum')->up_int($thread_data['fid'],array('posts[+]'=>1),$this->CacheObj);
   return $this->message(fy('留言成功'),true,'/t/'.intval(METHOD_NAME).'.html');
     
   }else{
      return $this->message(fy('未知错误'),false,'/t/'.intval(METHOD_NAME).'.html');
   }
 }
 $pageid=X('get.pageid');
 $this->v("PostList", $comm->read_list($pageid, $id,$this->conf['listnum'],'tid', $this->CacheObj));
$this->v("thread_data", $thread_data);
if (in_array($thread_data['mode'], array(1,2,3))) {
                $this->setmate(array(
                    'dname' => fy('评论'),
                    'm_key' => str_replace(' ', ',', $thread_data['keys']) ,
                    'm_des' => $thread_data['summary'],
                    'title' => fy('评论').' : '.$thread_data['title'] . '_' . $this->tmode[$thread_data['mode']], 
                ));
            } else {
                $this->setmate(array(
                   'dname' => fy('评论'),
                    'm_key' => str_replace(' ', ',', $thread_data['keys']) ,
                    'm_des' =>$thread_data['summary'],
                    'title' => fy('评论').' : '.$thread_data['title'],
                    
                ));
            }

$this->display('com_index');
 }
 

 

}
