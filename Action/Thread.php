<?php namespace Action;use YS\Action;!defined('YS_PATH')&&exit('YS_PATH not defined.');class Thread extends Ysv8 {

    public function __construct() {
        parent::__construct();
    }
    public function index() {
       $this->message(fy('没有该文章'),400,'/');
    }
	
	public function vote(){
        $this->check();
		$id=intval(X("post.id")); // 提交ID
		$type = X("post.type"); //类型
		if(!in_array($type,['goods','nos'])) return $this->json(["code"=>501,"info"=>fy('类型不对')]);

$Thread = M("Thread");
          if (!$thread_data = $Thread->read($id, $this->CacheObj)) return $this->json(["code"=>400,"info"=>fy('文章已被删除')]);
			if($this->_user['etime']<NOW_TIME-3600){
			if($type=='goods'){
if(mt_rand(20,30)==25)   $Thread->up_int($id, ['goods[+]'=>1,'btime[+]'=>NOW_TIME],$this->CacheObj);  else $Thread->up_int($id, ['goods[+]'=>1,'btime[+]'=>1000],$this->CacheObj);
			}else{
$Thread->up_int($id, ['nos[+]'=>1,'btime[-]'=>1000],$this->CacheObj);
			}
 M('User')->up_int(NOW_UID,array('etime'=>NOW_TIME),$this->CacheObj);}		
return $this->json(["code"=>200,"info"=>fy('投票成功')]);
				

	
	}
public function set_top() {
 if(!IS_ADMIN) return $this->json(array('code'=>502,'info'=>fy('权限不够')));
if(IS_POST){
$id=intval(X("post.id")); // 提交ID
$top = intval(X("post.type")); //类型
$Thread = M("Thread");
if (!$thread_data = $Thread->read($id, $this->CacheObj)) return $this->json(["code"=>400,"info"=>fy('文章已被删除')]);
$getkey=M('Mykey')->get_key($thread_data['title'],$this->CacheObj);
if($thread_data['mode']>0) $getkey[0]='mode'.$thread_data['mode'].' '.$getkey[0];
$Thread->up_int($id, ['goods[+]'=>1,'top'=>$top,'so' =>'fid'.$thread_data['fid'].' '.$getkey[0],'atime' =>NOW_TIME,'btime' =>NOW_TIME,'keys' =>$getkey[3]],$this->CacheObj);
M('User')->up_int($thread_data['uid'], ['gold[+]'=>100,'credits[+]'=>$top],$this->CacheObj);
return $this->json(["code"=>200,"info"=>fy('操作成功')]);
}
		}

    public function _no() {

            $pageid = intval(isset($_GET['YS_URL'][2]) ? $_GET['YS_URL'][2] : 0) or $pageid = 0;
            $id = intval(METHOD_NAME);
            $this->v('id', $id);
            $Thread = M("Thread");
            if (!$thread_data = $Thread->read($id, $this->CacheObj)) return $this->message(fy('不存在该主题'),false,'/');
			if ($thread_data['top']<6 and IS_ADMIN==false) return $this->message(fy('主题还在审核中'),false,'/');
            $thisf = M('Forum')->read($thread_data['fid'], $this->CacheObj);
            $this->v("fdate", $thisf);
           
		   if(mt_rand(5,25)==20)   $Thread->up_so($thread_data,$this->CacheObj);/*随机更新*/
		   
		   
            if ($thread_data['posts'] > 0) {
                $PostList = M("Comment")->read_list($pageid, $id,$this->conf['listnum'], 'tid',$this->CacheObj);
            } else {
                $PostList = array();
            }
       
if ($_GET['YS_ext'] == 'amp') $PostData = M('Post')->read_hash_amp($thread_data['pid'], $this->CacheObj); else $PostData = M('Post')->read_hash($thread_data['pid'], $this->CacheObj);
if (empty($PostData)) return $this->message(fy('错误'),false,'/'); 
	$filelist=[]; 
            if ($thread_data['files']) {
                $File = M("File");
                $filelist = explode(',', $thread_data['files']);
                foreach ($filelist as & $v) $v = $File->read($v, $this->CacheObj);
               
            }
			 $this->v("filelist", $filelist);
            $this->v("post_data", $PostData);
            $this->v("pageid", $pageid);
			     if ($thread_data['vs']){$thread_data['vs']=bucketcdn.$thread_data['vs'];$this->v('m_vod',$thread_data['vs']);}
            $this->v("thread_data", $thread_data);
            $this->v("PostList", $PostList);
            $this->v("data", M('Thread')->read_list($thread_data['btime'], $this->conf['listnum'], 0, $thread_data['fid'], 0, $this->CacheObj));
            if ($thread_data['img']) {
                $logoimg = img1($thread_data['img'], false);
            } else {
                $logoimg = bucketcdn . 'logo.png';
            }
       
            if (in_array($thread_data['mode'], array(1,2,3))) {
                $this->setmate(array(
                    'dname' => $thisf['name'],
                    'm_key' => str_replace(' ', ',', $thread_data['keys']) ,
                    'm_amp' => '//' . $thisf['lang'] . '.'.DOMAIN.'/t/' . $thread_data['id'] . '.amp',
                    'm_ca' => '//' . $thisf['lang'] . '.'.DOMAIN.'/t/' . $thread_data['id'] . '.html',
                    'm_des' => $thread_data['summary'],
                    'title' => $thread_data['title'] . '_' . $this->tmode[$thread_data['mode']] . '_' . $thisf['name'],
                    'm_img' => $logoimg,
                    'xml' => '//' . $thisf['lang'] . '.'.DOMAIN.'/index/index.feed?mode=' . $thread_data['mode'],
                    'btime' => $thread_data['btime'],
                    'atime' => $thread_data['atime'],
                    'author' => $thisf['name'],
                    'name' => $thread_data['user'],
                    'logo' => $thread_data['avatar']
                ));
            } else {
                $this->setmate(array(
                    'dname' => $thisf['name'],
                    'm_key' => str_replace(' ', ',', $thread_data['keys']) ,
                    'm_amp' => '//' . $thisf['lang'] . '.'.DOMAIN.'/t/' . $thread_data['id'] . '.amp',
                    'm_ca' => '//' . $thisf['lang'] . '.'.DOMAIN.'/t/' . $thread_data['id'] . '.html',
                    'm_des' =>$thread_data['summary'],
                    'title' => $thread_data['title'] . '_' . $thisf['name'],
                    'm_img' => $logoimg,
                    'xml' => '//' . $thisf['lang'] . '.'.DOMAIN.'/index/index.feed?mode=' . $thread_data['mode'],
                    'btime' => $thread_data['btime'],
                    'atime' => $thread_data['atime'],
                    'author' => $thisf['name'],
                    'name' => $thread_data['user'],
                    'logo' => $thread_data['avatar']
                ));
            }
            $this->display('thread_index');
        }

    
}

