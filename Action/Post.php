<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Post extends Ysv8 {
public $tid=0;
public $pid=0;
public $posts=0;
public $title;
public $content;
public $ante_type=0;
public function __construct() {
parent::__construct();

}

public function curl(){
$this->check();
if(!L("Usergroup")->read($this->_user['group'],'post')) return $this->json(array('error'=>false,'info'=>fy('权限不够')));
$this->curl2();
}

public function curl2(){
$uid=(NOW_UID>0)?NOW_UID:1;
$url=X('get.q');
if(strlen($url)<5) die('lost');
$ext=strrchr($url,'.');
$ch=curl_init();
$timeout=5;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_REFERER, $url);  
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$img=curl_exec($ch);
curl_close($ch);
$im = getimagesizefromstring($img);
if ($im === false) die('imlost'.$img);
$ext=str_replace('/','.',strrchr($im['mime'],'/'));
$upload = new \Lib\Local();
$upload->checkRootPath(INDEX_PATH. "upload/"); 
$info=$upload->save_http($img,$ext);
echo bucketcdn,$info,'@',$im[0],'|',$im[1];
if(in_array(strtolower(strrchr($info,'.')),array('.jpg','.jpeg','.png','.gif'))) M('Pic')->in($info,$im[0],$im[1],$uid);
die();


}

public function caiji(){
  if(IS_POST){
 $fid = intval(X("post.cid"));
 $thisuid = intval(X("post.uid"));
 $title = htmlspecialchars(trim(str_replace('»','_',trim(X("post.title"))),'_'));
 $vs= '';
 $files='';
 $title = preg_replace( '/\p{Thai}/u' , '' , $title );
$content = X('post.content');
if (get_magic_quotes_gpc())$content = stripslashes($content);
$content = L("Kses")->Parse($content);
$content=str_replace(bucketcdn,'{m}',preg_replace( '/\p{Thai}/u' , '' , $content ));
 $tmp = str_replace('&nbsp;','',$content);
 $tmp = trim(strip_tags($tmp,'<img><iframe><embed><video>'));
 if(empty($tmp)) return $this->json(array('code'=>501,'info'=>fy('内容不能为空')));
   if(mb_strlen($title) < $this->conf['titlemin']) return $this->json(array('code'=>501,'info'=>fy('标题长度不能小于'.$this->conf['titlemin'].'个字符')));
 if(mb_strlen($title) > $this->conf['titlesize']) return $this->json(array('code'=>501,'info'=>fy('标题长度不能大于'.$this->conf['titlesize'].'个字符')));
 if($fid < 0 ) return $this->json(array('code'=>501,'info'=>fy('请选择板块')));
 $pattern="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
 preg_match_all($pattern,$content,$match);
 $img = '';
 $sz=0;
 if(isset($match[1][0])){
 foreach ($match[1] as $v) {
  if(substr_count($v,'data:image/') || substr_count($v,';base64') || strpos($v,'/emoji/') !== FALSE || empty($v))
  continue;
  if($sz++<$this->conf['post_image_size']){
  $img.=$v.',';
  }
 }
 $img=trim($img,',');$mode=1;}else{$mode=0;}
if($files) $mode=2;
if($vs) $mode=3;
$hashid=$this->hashid($content);
$getkey=M('Mykey')->get_key($title,$this->CacheObj);
if($mode>0) $getkey[0]='mode'.$mode.' '.$getkey[0];
$tid=M('Thread')->in(array(
'fid'=>$fid,
'pid'=>$hashid,
'uid'=>$thisuid,
'title'=>$title,
'vs'=>$vs,
'files'=>$files,
'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
'atime' =>NOW_TIME,
'btime' =>NOW_TIME,
'mode' =>$mode,
'top'=>6,
'so' =>'fid'.$fid.' '.$getkey[0],
'keys' =>$getkey[3],
'img' =>$img,'lang' =>NOW_LANG));
$pid= M("Post")->in(array('tid' => $tid,'content' => $content,'hashid'=>$hashid),$this->CacheObj);
M('User')->up_int(NOW_UID,array('threads[+]'=>1,'gold[+]'=>$this->conf['gold_thread'],'credits[+]'=>$this->conf['credits_thread']),$this->CacheObj);
M('Forum')->up_int($fid,array('threads[+]'=>1),$this->CacheObj);
$this->json(array('code'=>200,'info'=>fy('发表成功'),'id'=>$tid));
}
  
echo 'no';
  

 }


 public function _no(){
 $id = intval(METHOD_NAME);
 $thisf = M('Forum')->read($id,$this->CacheObj);
 $this->v('id',$id);
 $this->v('title',$thisf['name'].'_'.fy('发布主题'));
 $this->v("fdata",$thisf);
 $this->display('post_index');
 }
 
 public function Index(){
 $this->check();
 $this->v('title',fy('发表主题'));
  if(IS_POST){
   $fid = intval(X("post.fid"));
   $title = trim(X("post.title"));

   $title = htmlspecialchars($title);
 $vs= str_replace(bucketcdn,'',trim(X("post.vs"),','));
 $files=trim(X("post.files"));
   
 $title = preg_replace( '/\p{Thai}/u' , '' , $title );
 $this->title=$title;

   $content = X('post.content');
   if(X("post.text")) $content =nl2br($content);/*纯文本模式*/
   if (get_magic_quotes_gpc())
  $content = stripslashes($content);
   
 if($this->_user['group'] != C("ADMIN_GROUP")){/*关键字*/
 $Kses =L("Kses");
   $content = $Kses->Parse($content);
 }
$content=str_replace(bucketcdn,'{m}',preg_replace( '/\p{Thai}/u' , '' , $content ));
 $tmp = str_replace('&nbsp;','',$content);
 $tmp = trim(strip_tags($tmp,'<img><iframe><embed><video>'));
   if(empty($tmp)) return $this->json(array('code'=>501,'info'=>fy('内容不能为空')));
   if(mb_strlen($title) < $this->conf['titlemin']) return $this->json(array('code'=>501,'info'=>fy('标题长度不能小于'.$this->conf['titlemin'].'个字符')));
 if(mb_strlen($title) > $this->conf['titlesize']) return $this->json(array('code'=>501,'info'=>fy('标题长度不能大于'.$this->conf['titlesize'].'个字符')));
 if($fid < 0 ) return $this->json(array('code'=>501,'info'=>fy('请选择板块')));
 $pattern="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
 preg_match_all($pattern,$content,$match);

/*api发表*/ 
$img=trim(X("post.imgv"),',');
if($img){
$info=explode(',',$img);
$img='';
$i=0;
foreach ($info as $value) {
$i++;
$value=img_w_h($value);
$imgv.='<p><img src="'.str_replace(bucketcdn,'{m}',$value[0]).'" '.$value[1].' /></p>';
if($i<$this->conf['post_image_size']){
$img.=','.str_replace(bucketcdn,'{m}',$value[0]);
}
}
$img=trim($img,',');
$mode=1;
$content.=$imgv;
}else{
 
 
 $img = '';
 $sz=0;
 if(isset($match[1][0])){
 foreach ($match[1] as $v) {
  if(substr_count($v,'data:image/') || substr_count($v,';base64') || strpos($v,'/emoji/') !== FALSE || empty($v))
  continue;
  if($sz++<$this->conf['post_image_size']){
  $img.=$v.',';
  }
 }
 $img=trim($img,',');
 $mode=1;}else{$mode=0;}
 }


 
 
if($files) $mode=2;
if($vs) $mode=3;
$hashid=$this->hashid($content);
if(!L("Usergroup")->read($this->_user['group'],'post')){/*需要审核*/
$tid=M('Thread')->in(array(
'fid'=>$fid,
'pid'=>$hashid,
'uid'=>NOW_UID,
'title'=>$title,
'vs'=>$vs,
'files'=>$files,
'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
'atime' =>0,
'btime' =>0,
'mode' =>$mode,
'top'=>0,
'so' =>'',
'keys' =>'',
'img' =>$img,'lang' =>NOW_LANG));
$pid= M("Post")->in(array('tid' => $tid,'content' => $content,'hashid'=>$hashid),$this->CacheObj);
M('User')->up_int(NOW_UID,array('threads[+]'=>1,'gold[+]'=>$this->conf['gold_thread'],'credits[+]'=>$this->conf['credits_thread']),$this->CacheObj);
M('Forum')->up_int($fid,array('threads[+]'=>1),$this->CacheObj);
$this->json(array('code'=>200,'info'=>fy('发表成功'),'id'=>$tid)); 
   }else{ 
$getkey=M('Mykey')->get_key($title,$this->CacheObj);
if($mode>0) $getkey[0]='mode'.$mode.' '.$getkey[0];
$tid=M('Thread')->in(array(
'fid'=>$fid,
'pid'=>$hashid,
'uid'=>NOW_UID,
'title'=>$title,
'vs'=>$vs,
'files'=>$files,
'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
'atime' =>NOW_TIME,
'btime' =>NOW_TIME,
'mode' =>$mode,
'top'=>6,
'so' =>'fid'.$fid.' '.$getkey[0],
'keys' =>$getkey[3],
'img' =>$img,'lang' =>NOW_LANG));
$pid= M("Post")->in(array('tid' => $tid,'content' => $content,'hashid'=>$hashid),$this->CacheObj);
M('User')->up_int(NOW_UID,array('threads[+]'=>1,'gold[+]'=>$this->conf['gold_thread'],'credits[+]'=>$this->conf['credits_thread']),$this->CacheObj);
M('Forum')->up_int($fid,array('threads[+]'=>1),$this->CacheObj);
$this->json(array('code'=>200,'info'=>fy('发表成功'),'id'=>$tid));
   }
   exit;
  }
  
$this->display('post_index');
  

 }

 
 
 

 
 public function uploadfiles(){
  if(!L("Usergroup")->read($this->_user['group'],'upload')) return $this->json(array('error'=>false,'info'=>fy('权限不够')));
 $upload = new \Lib\Upload();
  $upload->maxSize =  ($this->conf['uploadfilemax']*1024)*1024 ;
  $upload->exts = array('chm','doc','docx','xlsx','ppt','pdf','xls','txt','pdf','zip','rar','mp3','mp4');
  $upload->rootPath =  INDEX_PATH. "upload/"; 
  $upload->replace = true;
  $upload->autoSub = false;
  $info = $upload->upload();
  if($info) {
if(!$id=S('File')->insert(array(
   'uid' => NOW_UID,
   'filename' => isset($info['photo'])?substr($info['photo']['name'],0,strrpos($info['photo']['name'], '.')):'NO_NAME.'.$info['photo']['ext'],
   'md5name' => substr($info['photo']['savename'],0,strrpos($info['photo']['savename'], '.')),
      'ext' => $info['photo']['ext'],
	   'lang' => NOW_LANG,
   'filesize' => $info['photo']['size'],
   'atime' => NOW_TIME,
      'btime' => NOW_TIME
   ))){
   $id=S('File')->find('id',array('md5name'=>substr($info['photo']['savename'],0,strrpos($info['photo']['savename'], '.'))));
   }

   $file_size = $info['photo']['size'] / 1024; 
 if($file_size < 1 && $file_size > 0) 
 $file_size = 1;
M("User")->up_int(NOW_UID,array('file_size[+]'=>$file_size),$this->CacheObj);
   $this->json(array('success'=>true,'info'=>"上传成功",'id'=>$id,'ext'=>$info['photo']['ext'],'file_path'=>bucketcdn .$info['photo']['savename'],'name'=>$info['photo']['name']));
  }
  $this->json(array('success'=>false,"info"=>$upload->getError()));
  
 }
 
 public function upload(){
if(!L("Usergroup")->read($this->_user['group'],'upload')) return $this->json(array('error'=>false,'info'=>fy('权限不够')));
 $upload = new \Lib\Upload();
  $upload->maxSize =  ($this->conf['uploadimagemax']*1024)*1024 ;

  $upload->exts  =  explode(",",$this->conf['uploadimageext']);
  $upload->rootPath =  INDEX_PATH. "upload/"; 

  $upload->replace = true;
  $upload->autoSub = false;

 
 $info = $upload->upload();

 
 $d=array("success"=>true,'msg'=>"success","file_path"=>'','type'=>'.'.$info['photo']['ext'],'ext'=>$info['photo']['ext'],'name'=>$_FILES['photo']['name'],'originalName'=>$_FILES['photo']['name']);
 if(!$info) {
 $d['success'] = false;
 $d['state'] = 'FAIL';
 $d['msg'] = $upload->getError();
 }else{ 
$d['file_path'] = bucketcdn .$info['photo']['savename'];
$d['url'] = $d['file_path'];
$d['w'] = $info['img'][0];
$d['h'] = $info['img'][1];
$d['state'] = 'SUCCESS';
$file_size = $info['photo']['size'] / 1024;
if($file_size < 1 && $file_size > 0) $file_size = 1;
M("User")->up_int(NOW_UID,array('file_size[+]'=>$file_size),$this->CacheObj);

if(in_array(strtolower($info['photo']['ext']),array('jpg','jpeg','png','gif'))) M('Pic')->in($info['photo']['savename'],$d['w'],$d['h'],NOW_UID);


}
 if(X("post.geturl") == '1') die($d['file_path']);
 $this->json($d);

 }
 
 public function edit(){
 $this->check();
  $this->v('title',fy('编辑'));
  $id = (isset($_GET['YS_URL'][2]) ? $_GET['YS_URL'][2] : '0') or $id='0';
 if(IS_POST){

 if(!IS_ADMIN) return $this->json(array('code'=>502,'info'=>fy('权限不够')));

 $content = X('post.content');
 $content = str_replace(array('<br/><br/>','<p><br/></p>'),'<br/>',$content);
  $Thread = M("Thread");
  $Thread_data = $Thread->read($id,$this->CacheObj);
  if(empty($Thread_data)) return $this->json(array("code"=>400,"info"=>fy('文章不存在')));
 if($this->_user['group'] != C("ADMIN_GROUP")){
 $Kses =L("Kses");
   $content = $Kses->Parse($content);
 }

 $title = trim(X("post.title"));
 $title = htmlspecialchars($title);
 $title = preg_replace( '/\p{Thai}/u' , '' , $title );
if(mb_strlen($title) < $this->conf['titlemin']) return $this->json(array('code'=>501,'info'=>fy('标题太短')));
if(mb_strlen($title) > $this->conf['titlesize']) return $this->json(array('code'=>501,'info'=>fy('标题太长')));
  //获取所有图片地址
 $pattern="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
 preg_match_all($pattern,$content,$match);
 $img = '';
 $sz=0;
 $mode=0;
 if(isset($match[1][0])){
 foreach ($match[1] as $v) {
 if(substr_count($v,'data:image/') || substr_count($v,';base64') || strpos($v,'/emoji/') !== FALSE || empty($v))
 continue;
 $sz++;
 if($sz<$this->conf['post_image_size']) $img.=$v.',';
 }
 $img=trim($img,',');
 }
 if($img) $mode=1;
$mode=max($Thread_data['mode'],$mode);
 
$getkey=M('Mykey')->get_key($title,$this->CacheObj);
if($mode>0) $getkey[0]='mode'.$mode.' '.$getkey[0];
$hashid=$this->hashid($content);
$pid= M("Post")->in(array('tid' => $id,'content' => $content,'hashid'=>$hashid),$this->CacheObj);
 $Thread->up_int($id,array(
'title'=>$title,
'img' => $img,
  'so' =>'fid'.$Thread_data['fid'].' '.$getkey[0],
'keys' =>$getkey[3],
  'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
'pid' => $hashid
),$this->CacheObj);

 return $this->json(array('code'=>200,'info'=>fy('成功'),'id'=>$id));
 } 
$thread_data = M("Thread")->read($id,$this->CacheObj);
if(empty($thread_data)) return $this->message(fy('内容不存在'),'401','/');
$data = M("Post")->read_hash($thread_data['pid'],$this->CacheObj);
$this->v('thread_data',$thread_data);
$this->v('id',$id);
$this->v("data",$data);
$this->display("edit_post");
 }
 

 

 

}
