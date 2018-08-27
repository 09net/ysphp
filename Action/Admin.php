<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Admin extends Ysv8 {
 public $menu_action =array();
 public function __construct(){
 parent::__construct();
 $this->view = 'admin';
 define('APP_WWW', 'https://'.NOW_LANG.'.picadv.com/');
 define("APP_token", $this->conf['token']);
 if(!IS_LOGIN){header('Location: /user/login');exit;}

 if($this->_user['group'] < C("ADMIN_GROUP")) return $this->message(fy("您不是管理员"),502,'/');
 session('[start]');
 $md5 = session('setting');
 if(empty($md5)){$this->login();exit();}
 $url1 = X("server.HTTP_REFERER");
 $reg = '/\/\/([^\/]+)/i'; 
 preg_match($reg, $url1,$res1);
 preg_match($reg, WWW,$res2);
 if(!isset($res1[1]) || !isset($res2[1])) return $this->out();
 if($res1[1] != $res2[1]) return $this->out();
 $this->menu_action = array('index'=>'','forum'=>'','user'=>'','thread'=>'','mykey'=>'','fy'=>'','view'=>'','op'=>'','code'=>'');
 $this->v("menu_action",$this->menu_action);
 }


public function fy(){/*分词调教*/
 if(IS_POST){
$size=X('get.size');
$mykey=X('post.mykey');
$mykey2=X('post.mykey2');
switch ($size){
case 'add':
fy($mykey, 'zh',NOW_LANG,$mykey2);
$this->v("add",fy('设置成功'));
break; 
case 'get':
$this->v("mykey",$mykey);
$this->v("get",fy($mykey));
break; 
default:
 }} 
 $this->display("fy");
 }

public function mykey(){/*分词调教*/
 if(IS_POST){
 $size=X('get.size');
 switch ($size){
case 'add':
 $mykey=X('post.mykey');
if(M('Mykey')->like($mykey,$this->CacheObj,'add')) $this->v("Mykeystr",'添加成功');
 break; 
 case 'get':
 $mykey=X('post.content');$this->v("mykey", $mykey);
if($mykey and $data=M('Mykey')->get_key($mykey,$this->CacheObj)) $this->v("fenci",$data);
 break; 
default:}}
$this->display("mykey");
 }

 public function index(){
 
 if(IS_POST){
 $one1 = X("post.one1"); 
 $one3 = X("post.one3") ? true : false; 
 $one4 = X("post.one4");
 $lang = X("post.lang"); 
 if(!empty($lang)) del_fycache_data($this->conf);/*删除语言文件*/
 if($one1) del_cache_file($this->conf);
 if($one3) del_cache_data($this->conf);
 if($one4) if(is_file(TMP_PATH.'log.php')) unlink(TMP_PATH.'log.php');

 if(IS_AJAX)
 $this->json(['code'=>200,'info'=>'Success']);
 header('Location: /admin');
 exit;
 }

 $this->display('index');

 }
 public function login(){
 if($this->_user['group']< C("ADMIN_GROUP"))  return $this->message(fy("您不是管理员"),502,'/');
 if(IS_POST){
 $pass = X("post.pass");
 if(L("User")->md5_md5($pass, $this->_user['salt']) == $this->_user['pass']){
 session('setting','ok');
 header('Location: /admin');
 exit;
 }
 if(IS_AJAX)
 $this->json(['code'=>301,'info'=>fy('登陆过期'),'data'=>fy('登陆过期')]);
 else
 $this->v("info",fy('密码错误'));
 }
 $this->display("login");
 }
 public function out(){
 session('[destroy]');
 header('Location: /admin');
 exit;

 }
 public function forum_group(){
 $Forum = S("Forum");
 $Forum_group = S("Forum_group");
 if(IS_GET){
 $id = X("get.del");
 if(!empty($id)){
 $Forum_group->delete(array('id'=>$id));
 header('Location: /admin/forum_group');
 }
 }
 if(IS_POST){
 $gn = X('post.gn');
 if($gn == 'add'){
 $fg_name = X("post.fg_name");
 if(empty($fg_name))
 return $this->mess(fy('名称为空'));
 if($Forum_group->insert(array('name'=>$fg_name)) === false)
 return $this->mess(fy('未知错误'));
 header('Location: /admin/forum_group');
 exit;
 }
 else if($gn == 'edit'){
 $fgid = X("post.fgid");
 $edit_id = X("post.edit_id");
 $edit_name = X("post.edit_name");
 if($Forum_group->has(array('id'=>$fgid))){
 $Forum_group->update(array('id'=>$edit_id,'name'=>$edit_name),array('id'=>$fgid));
 }
 header('Location: /admin/forum_group');
 exit;
 }else if($gn == 'move'){
 $fid = X("post.fid");
 $move_fg = X("post.move_fg");
 $Forum->update(array('fgid'=>$move_fg),array('id'=>$fid));
 $this->CacheObj->forum = NULL;
 header('Location: /admin/forum_group');
 exit;
 }
 return $this->mess(fy('参数不足'));
 
 }
 $data = $Forum_group->select('*');
 $forum_data = $Forum->select('*');
 $this->v("data",$data);
 $this->v("forum_data",$forum_data);
 $this->display("forum_group");
 }
 public function forum(){
 if(IS_POST){
 $gn = (X("post.gn"));
 $id = intval(X("post.id"));
 $name = X("post.name");
 $name2 = X("post.name2");
 $color = X("post.color");
 $background = X("post.background");
 $html = X("post.html");
 $fid = intval(X("post.fid"));
 if(empty($gn))  return $this->mess(fy('参数不足'));
 $Forum = M("Forum");
 if($gn == '1') 
 {
 $Forum->insert(array(
 "name" => $name,
 "name2" => $name2,
 'fid' => $fid,
 'color' => $color,
 'background'=> $background,
 'html' => $html,
 'atime' => NOW_TIME,
 'btime' => NOW_TIME,
 'lang' => NOW_LANG
 )
 );
 return $this->mess(fy('成功'));
 }elseif($gn == '2'){ 
 $iid = intval(X("post.iid")); 
 if($iid < 0 )
 return $this->mess(fy('参数不足').'2');

 $data = $Forum->read($iid);

 if($id != $iid){ 
 
 S("Post")->update(array('fid'=>$id),array('fid'=>$iid));
 S("Thread")->update(array('fid'=>$id),array('fid'=>$iid));
 $Forum->update(array('fid'=>$id),array('fid'=>$iid));
 
 }
 $Forum->update(array(
 'id'=>$id,
 'name'=>$name,
 "name2"=>$name2,
 'fid'=>$fid,
 'color' =>$color,
 'background'=>$background,
 'html' => $html
 ),array('id'=>$iid));

 return $this->mess(fy('成功'));
 }elseif($gn == '3'){ /*删除分类*/
 
 S("Thread")->delete(array('fid'=>$id));
 S("Post")->delete(array('fid'=>$id));
 $Forum->delete(array('id'=>$id));
 
 return $this->json(array('code'=>200,"info"=>'good'));
 }else if($gn == 'move'){ 
 $move_f1 = intval(X("post.move_f1"));
 $move_f2 = intval(X("post.move_f2"));
 $move_check = X("post.move_check");

 if($move_check != 'on')
 return $this->mess(fy('请选择'));
 if($move_f1 == $move_f2)
 return $this->mess(fy('错误'));

 S("Thread")->update(array('fid'=>$move_f2),array('fid'=>$move_f1));
 S("Post")->update(array('fid'=>$move_f2),array('fid'=>$move_f1));
 $Forum = S('Forum');
 $Forum->update(array('threads'=>0,'posts'=>0),array('id'=>$move_f1));
 $Forum->update(array('threads'=>S("Thread")->count(array('fid'=>$move_f2)),'posts'=>S("Post")->count(array('fid'=>$move_f2))),array('id'=>$move_f2));
 return $this->mess('移动完成');


 }
 return $this->mess(fy('参数不足'));
 }else{
 
 $Forum = S("Forum");

 $this->v("data",M('Forum')->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj));
 $this->v("forum",M('Forum')->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj));
 $this->v("data1",M('Forum')->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj));
 $this->v("pageid",1);
 $this->v("page_count",1);
 
 $this->display("forum");
 }



 }
 
 public function user(){

 if(IS_POST){
 $gn = intval(X("post.gn"));
 if($gn=='2'){ 

 $user = X("post.user");
 $pass = X("post.pass");
 $email = X("post.email");
 $group = X("post.group");
 $User = M("User");
 if($User->is_user($user))
 return $this->mess(fy('账号重复'));
 if($User->is_email($email))
 return $this->mess(fy('邮箱重复'));
 $User->add_user($user,$pass,$email,$group);
 return $this->mess(fy('成功'));
 }elseif($gn=='3'){ 
 $uid = intval(X("post.id"));
 $user = X("post.user");
 $pass = X("post.pass");
 $gid = X("post.group");
 $email = X("post.email");
 $gold = X("post.gold");
 $credits = X("post.credits");
 $User = M("User");
 $data = $User->read($uid,$this->CacheObj);

 if($data['user'] != $user){
 if($User->is_user($user)) return $this->mess(fy('账号重复'));
 }

 if($data['email'] != $email){
 if($User->is_email($email)) return $this->mess(fy('邮箱重复'));
 }
 $xiu = array(
 'user'=>$user,
 'email'=>$email,
 'group'=>$gid,
 'gold'=>$gold,
 'credits'=>$credits

 );
 if(!empty($pass)) $xiu['pass'] = L("User")->md5_md5($pass,$data['salt']);
 $User->up_int($uid, $xiu,$this->CacheObj);
 
 

 return $this->mess(fy('修改成功'));

 }elseif($gn == '4'){ 
 $uid = intval(X("post.id"));
 $User = S("User");
 $User->delete(['uid'=>$uid]);

 S("Thread")->delete(array('uid'=>$uid));

 S("Chat")->delete(array('OR'=>array('uid1'=>$uid,'uid2'=>$uid)));
 S("Chat_count")->delete(array('uid'=>$uid));
 S("Chat_pm")->delete(array('OR'=>array('uid1'=>$uid,'uid2'=>$uid)));

 S("Friend")->delete(array('OR'=>array('uid1'=>$uid,'uid2'=>$uid)));

 return $this->json(array('code'=>200,'info'=>fy('删除成功')));
 }elseif($gn == 'del_more'){ 
 if(X('post.del_post') == 'on'){ 
 $uid = X('post.id');
 if(is_array($uid)){
 $User = S("User");
 $Thread = S("Thread");
 $Post = S("Post");
 $Chat = S("Chat");
 $Chat_count = S("Chat_count");
 $Chat_pm = S("Chat_pm");
 $File = S("File");
 $Filegold = S("Filegold");
 $Fileinfo = S("Fileinfo");
 $Friend = S("Friend");
 $Ol = S("Online");
 $Threadgold = S("Threadgold");
 $Vote_post = S("Vote_post");
 $Vote_thread = S("Vote_thread");
 foreach ($uid as $v) {
 $User->delete(['uid'=>$v]);
 $Thread->delete(array('uid'=>$v));

 $Chat->delete(array('OR'=>array('uid1'=>$v,'uid2'=>$v)));
 $Chat_count->delete(array('uid'=>$v));
 $Chat_pm->delete(array('OR'=>array('uid1'=>$v,'uid2'=>$v)));



 $Friend->delete(array('OR'=>array('uid1'=>$v,'uid2'=>$v)));
 $Ol->delete(array('uid'=>$v));
 $Threadgold->delete(array('uid'=>$v));

 }
 header('Location: '. X("server.HTTP_REFERER"));
 return $this->mess(fy('删除成功'));
 }
 return $this->mess(fy('未选择'));
 }
 
 return $this->mess(fy('未确认'));
 
 }
 return $this->mess(fy('参数错误'));
 }


 $gn = intval(X("get.gn"));
 $pageid=X('get.pageid');
 if(!empty($gn)){ 
$this->v('data',M("User")->read_list_user_email(X('get.user'), $this->conf['listnum'],$this->CacheObj));
 }else{
 
 $this->v('data',M("User")->read_list($pageid , $this->conf['listnum'],$this->CacheObj));
 }
 $this->display("user");
 

 }
 
 
 
 public function thread(){
 $Thread=M('Thread');
if(IS_POST){
 $gn = X("post.gn");
 if($gn == 'del'){
 $tid = X("post.id");
if(!empty($tid)){
 foreach ($tid as &$v) {$v=intval($v);$Thread ->del($v, $this->CacheObj);}
$this->CacheObj->rm('tl0_0-1'.NOW_LANG.ceil(NOW_TIME/300)*300); 
 }
 }
 } 
$top = X("get.top"); 
 $pageid=isset($_GET['YS_URL'][2]) ? intval($_GET['YS_URL'][2]) : 0;
if($top>0){$this->v("data",M('Thread')->top_list($top,$this->CacheObj));}else{
 $fid = X("get.forum"); 
 if($fid ==='') $fid = -1;
 $this->v("data",M('Thread')->read_list($pageid,$this->conf['listnum'],0,$fid,0,$this->CacheObj));
 }
 $this->display('thread');
 }
 public function post(){
 if(IS_POST){
 $gn = X("post.gn");
 if($gn == 'del'){
 $pid = X("post.id");
$cm=M("Comment");
 if(!empty($pid)){
 foreach ($pid as &$v) {
 $v=intval($v);$cm ->del($v, $this->CacheObj);}
$this->CacheObj->rm('cmt0l0_'.ceil(NOW_TIME/300)*300);
 }
 }
 }

 $pageid=intval(isset($_GET['YS_URL'][2]) ? $_GET['YS_URL'][2] : 0) or $pageid=0;
 $this->v("data",M("Comment")->read_list($pageid, 0,$this->conf['listnum'],0, $this->CacheObj));
 $this->display('post');
 }
 
 private function mess($a){
 $this->v('mess',$a);
 $this->display("message");
 }
 
 public function op(){
 if(IS_POST){
 $this->conf['title']=X("post.title");
 $this->conf['logo']=X("post.logo");
 $this->conf['title2']= X("post.title2");
 $this->conf['keywords']= X("post.keywords");
 $this->conf['de']=X("post.de");
 $this->conf['gold_thread']=intval(X("post.gold_thread"));
 $this->conf['gold_post']= intval(X("post.gold_post"));
 $this->conf['credits_thread']= intval(X("post.credits_thread"));
 $this->conf['credits_post']= intval(X("post.credits_post")); 
 $this->conf['listnum']= intval(X("post.listnum")); 
 $this->conf['send_email_s']= intval(X('post.send_email_s'));
 $this->conf['out_s']= intval(X('post.out_s'));
 $this->conf['mp3_friend']= X('post.mp3_friend');
 $this->conf['mp3_system']= X('post.mp3_system');
 $this->conf['badword']= X('post.badword');
 $this->conf['titlesize']= intval(X("post.titlesize"));
 $this->conf['titlemin']= intval(X("post.titlemin"));
 $this->conf['summary_size']= intval(X("post.summary_size"));
 $this->conf['emailhost']= X("post.emailhost");
 $this->conf['emailuser']= X("post.emailuser");
 $this->conf['emailpass']= X("post.emailpass");
 $this->conf['emailport']= intval(X("post.emailport"));
 $this->conf['emailtitle']= X("post.emailtitle");
 $this->conf['emailcontent']= X("post.emailcontent");
 $this->conf['post_image_size']= X("post.post_image_size");
 $this->conf['uploadimageext']= X("post.uploadimageext");
 $this->conf['uploadfileext']= X("post.uploadfileext");
 $this->conf['cache_type']= X("post.cache_type");
 $this->conf['cache_table']= X("post.cache_table");
 $this->conf['cache_key']= X("post.cache_key");
 $this->conf['cache_time']= X("post.cache_time");
 $this->conf['cache_pr']= X("post.cache_pr");
 $this->conf['cache_ys']= X("post.cache_ys");
 $this->conf['usergroup']= X("post.usergroup");
 $this->conf['fgold']= X("post.fgold");
 $this->conf['cache_outtime']= X("post.cache_outtime");
 $this->conf['cache_redis_ip']= X("post.cache_redis_ip");
 $this->conf['cache_redis_port']= X("post.cache_redis_port");
 $this->conf['cache_mem_ip']= X("post.cache_mem_ip");
 $this->conf['cache_mem_port']= X("post.cache_mem_port");
 $this->conf['cache_memd_ip']= X("post.cache_memd_ip");
 $this->conf['debug_page']= X("post.debug_page");
 $this->conf['uploadimagemax']= X("post.uploadimagemax");
 $this->conf['uploadfilemax']= X("post.uploadfilemax");
 $this->conf['listnum']= X("post.listnum");
 $this->conf['adminuser']= X("post.adminuser");
 $this->conf['bucketcdn']=X("post.bucketcdn");/*小图片cdn加速*/
 $this->conf['imgcdn']=X("post.imgcdn");/*大图片cdn加速*/
 $this->conf['icdn']=X("post.icdn");/*静态cdn加速*/
 $this->conf['token']= trim(X("post.token"));
 $this->conf['user_bool']= X("post.user_bool");
 $this->conf['OSS_ACCESS_ID']= X("post.OSS_ACCESS_ID");
 $this->conf['OSS_ACCESS_KEY']= X("post.OSS_ACCESS_KEY");
 $this->conf['OSS_ENDPOINT']= X("post.OSS_ENDPOINT");
  $this->conf['OSS_BUCKET']= X("post.OSS_BUCKET");
    $this->conf['WX_APPID']= X("post.WX_APPID");
	  $this->conf['WX_AppSecret']= X("post.WX_AppSecret");
 file_put_contents(CONF_PATH . 'conf.php' , "<?php die(); ?>\r\n".json_encode($this->conf));
 $this->json(array('code'=>200,'info'=>fy('修改成功')));
 }

 $this->v("conf",$this->conf);
 $this->display('op');
 }

 
 public function forumg(){

 if(IS_POST){
 
 $this->CacheObj->rm('forum');
 $gn = X("post.gn");
 $id = X("post.id");
 $user = X("post.user");
 if($gn == 'forumg'){
 S("Forum")->update(array(
 'forumg'=>$user
 ),array(
 'id'=>$id
 ));
 return $this->mess(fy('修改完成'));
 }else{
 $forum = M("Forum")->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj);
 $arr = json_decode($forum[$id]['json'],true);
 $arr[$gn] = $user;
 S("Forum")->update(array('json'=>json_encode($arr)),array('id'=>$id));

 }
 }
 if(IS_AJAX){
 $id = X("get.id");
 $gn = X("get.gn");

 if($gn == 'forumg'){
 if($id > -1){
 $user = S("Forum")->find("forumg",array(
 'id'=>$id
 ));
 $this->v("user",$user);
 $this->v("id",$id);
 $this->display("ajax_forum");
 exit;
 }
 }else{
 $forum = M("Forum")->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj);
 $arr = json_decode($forum[$id]['json'],true);
 $this->v("user",isset($arr[$gn])?$arr[$gn]:'');
 $this->v("id",$id);
 $this->display("ajax_forum");
 exit;
 }


 }


 $Forum = S("Forum");
 $data = $Forum->select("*");

 $User = M("User");
 foreach ($data as &$v) {
 $tmp = explode(",",$v['forumg']);
 if(!count($tmp))
 continue;
 $v['user'] = array();
 foreach ($tmp as $vv) {
 $v['user'][]=$User->uid_to_user(intval($vv),$this->CacheObj);

 }
 
 unset($tmp);
 }
 

 $this->v("data",$data);
 $this->display('forumg');
 }
 public function forum_json(){

 if(IS_POST){
 
 $this->CacheObj->rm('forum');
 $gn = X("post.gn");
 $id = X("post.id");
 $user = X("post.user");
 if($gn == 'forumg'){
 S("Forum")->update([
 'forumg'=>$user
 ],[
 'id'=>$id
 ]);
 $this->CacheObj->rm('forum');
 return $this->mess(fy('修改完成'));
 }else{
 $forum = M("Forum")->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj);
 $arr = json_decode($forum[$id]['json'],true);
 $arr[$gn] = $user;
 S("Forum")->update(array(
 'json'=>json_encode($arr)
 ),array(
 'id'=>$id
 ));
 $this->CacheObj->rm('forum');

 }
 }

 
 if(IS_AJAX){
 $id = X("get.id");
 $gn = X("get.gn");

 if($gn == 'forumg'){
 if($id > -1){
 $user = S("Forum")->find("forumg",array(
 'id'=>$id
 ));
 $this->v("user",$user);
 $this->v("id",$id);
 $this->display("ajax_forum1");
 exit;
 }
 }else{
 $forum = M("Forum")->read_list(0 , $this->conf['listnum'],-1,$this->CacheObj);
 $arr = json_decode($forum[$id]['json'],true);
 $this->v("user",isset($arr[$gn])?$arr[$gn]:'');
 $this->v("id",$id);
 $this->display("ajax_forum1");
 exit;
 }


 }


 $Forum = S("Forum");
 $data = $Forum->select("*");

 
 $Usergroup = M("Usergroup");
 foreach ($data as &$v) {
 $arr = json_decode($v['json'],true);
 $v['jsonarr'] = array(
 "vforum"=>array(),
 'vthread'=>array(),
 'thread'=>array(),
 'post'=>array(),
 'downfile'=>array(),
 );

 if(is_array($arr)){
 foreach ($arr as $key=>$value) {
 $v['jsonarr']["$key"]=array();
 
 $tmp = explode(",",$arr["$key"]);
 if(!count($tmp))
 continue;

 foreach ($tmp as $vv) {
 $v['jsonarr']["$key"][]=$Usergroup->gid_to_name(intval($vv));
 }
 unset($tmp);
 }
 }
 }
 $this->v("data",$data);
 $this->display('forum_json');
 }
 
 public function forumupload(){
 $upload = new \Lib\Upload();
 $upload->maxSize = 3145728 ;
 $upload->exts = explode(",",$this->conf['uploadimageext']);
 $upload->rootPath = INDEX_PATH. "upload/"; 

 $upload->replace = true;
 $upload->autoSub = false;
 if(!is_dir(INDEX_PATH. "upload")) mkdir(INDEX_PATH. "upload");

 $info = $upload->upload();

 if(!$info) {
 return $this->mess(fy('错误') . $upload->getError());
 }else{
 M('Forum')->up_int(X("post.forum"),array('img'=>$info['photo']['savename']),$this->CacheObj);
 header('Location: /admin/forum');
 exit;
 }


 }
 
 
 
 public function getip(){
 
 $curl = curl_init();
 $url = APP_WWW . 'open/getip?tk='.APP_token;
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_HEADER, 0);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $data = curl_exec($curl);
 curl_close($curl);
 die($data);
 }
 
 public function log(){
 if(IS_POST){
 $pageid = X("post.page_id");
 $page_size = X("post.page_size");
 $user = X("post.user");
 $select_type = array(
 "LIMIT" => array(($pageid-1) * $page_size, $page_size),
 "ORDER" => ['id'=>'DESC']
 );
 if(!empty($user)){
 $uid = M("User")->user_to_id(trim($user));
 $select_type['uid']=$uid;
 }
 $data = S("Log")->select("*",
 $select_type
 );

 $User=M("User");
 if(empty($data))
 $data=array();
 foreach ($data as &$v) {
 $v['user']=$User->uid_to_user($v['uid']);
 $v['time']=date('Y-m-d H:is',$v['atime']);
 }

 $this->json(array('200'=>empty($data)?400:200,'data'=>$data));
 }
 $data = S("Log")->select("*",array("ORDER" => ['id'=>'DESC'],'LIMIT'=>10));
 

 $User=M("User");
 if(empty($data))
 $data=array();
 foreach ($data as &$v) {
 $v['user']=$User->uid_to_user($v['uid']);
 }
 $this->v("data",$data);
 $this->display("log");
 }
 
 
 public function is_rewrite(){
 die('on');
 }



 
}
