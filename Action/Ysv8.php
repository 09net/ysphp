<?php namespace Action;use YS\Action;!defined('YS_PATH')&&exit('YS_PATH not defined.');
class Ysv8 extends Action {
 public $_user=array(); //当前用户数据
     public $tmode = array('','图片','下载','视频');
 public $_login=false; //当前是否登录
  public $_forum=array(); //当前是否登录
 public $_usergroup=array();
public $_uid = -1;

public $_theme;
public $conf;
public $CacheObj;
public function __construct() {
$this->v('langa', unserialize(LANGA));
$this->init_conf();
if (empty($this->conf['debug_page'])) C("DEBUG_PAGE", false);else C("DEBUG_PAGE", true);
if (IS_SHOUJI) $this->_theme = $this->view = $this->conf['wapview']; else $this->_theme = $this->view = $this->conf['theme'];
define('THEME_NAME', $this->_theme);
define('WWW', '//'.NOW_LANG.'.'.DOMAIN.'/');
$this->v('title', $this->conf['title']);
$this->CacheObj = cache(array());
if($this->conf['user_bool'] or ACTION_NAME=='Admin') $this->init_user();
define("NOW_UID",$this->_uid); //当前用户组
define("IS_LOGIN",$this->_login);
if (IS_LOGIN and $this->_user['group'] >= C("ADMIN_GROUP"))   define("IS_ADMIN",true); else define("IS_ADMIN",false);
 }
 
 protected function init_group(){
 $usergroup=M('Usergroup')->read_all($this->CacheObj);
 $this->_usergroup=$usergroup;
 $this->v("usergroup",$this->_usergroup);
 }
  protected function init_forum(){
  $this->_forum=M('Forum')->read_list(0,10,-1,$this->CacheObj);
  $this->v("forum",$this->_forum);
 }
 
	protected function init_user(){
 $this->init_forum(); 
 $this->init_group();
 $cookie = cookie("YSPHP_HEX");
 if(empty($cookie)) $cookie =X('post.YSV8_HEX');
 if(empty($cookie)) return false;
 $user = L("User")->get_cookie($cookie);
 if(empty($user) or !isset($user['id']) or !isset($user['user'])){cookie('YSPHP_HEX',null);return false;}
  $user_data = M("User")->read($user['id'],$this->CacheObj);
  if($user_data['user'] != $user['user']){cookie('YSPHP_HEX',null); return false;}
  if($user_data['group']==0){
  $this->message("账号已经被管理员锁定，禁止登陆!");
  cookie('YSPHP_HEX',null);
  return false;
  }
  
  $this->_uid = $user_data['id'];
  $user = $user_data;
  $user['mess'] = M("Chat_count")->get_c($user['id'],$this->CacheObj);
  $this->_user = $user;
  $this->_login=true;
  $this->v('user',$this->_user);
 }
	
	
 protected function init_conf() {
$tmp_conf = array(
 'title' => 'YSPHP',
'title2' => ' _ YSPHP',
 'logo' => 'YSPHP',
 'keywords' => 'YSPHP',
 'description' => 'YSPHP:开源的多语言框架',
 'theme' => 'YS_pc',
 'wapview' => 'YS_wap',
 'send_email_s' => '300',
 'out_s' => '300',
 'emailtitle' => 'YSPHP找回密码验证码邮件',
 'emailcontent' => '您的用户名为：%s，本次操作验证码为：%s',
 'mp3_friend' => 'public/mp3/msg.mp3',
 'mp3_system' => 'public/mp3/system.mp3',
 'gold_thread' => 2,
 'gold_post' => 2,
 'credits_thread' => 2,
 'credits_post' => 2,
 'listnum' => 10,
 'usergroup' => 3,
 'titlesize' => 128,
 'titlemin' => 5,
 'summary_size' => 200,
 'emailhost' => '',
 'emailuser' => '',
 'emailpass' => '',
 'emailport' => '',
  'fgold' => 0,
 'uploadfileext' => 'zip,rar',
 'uploadimageext' => 'jpg,gif,png,jpeg,bmp',
 'post_image_size' => 3,
 'badword'=>'操|草泥马|操你|妈逼|caonima|nimabi',
 'cache_type' => 'DB',
 'cache_table' => 'cache',
 'cache_key' => null,
 'cache_time' => 60,
 'cache_pr' => null,
 'cache_ys' => false,
 'cache_outtime' => null,
 'cache_redis_ip' => null,
 'cache_redis_port' => null,
 'cache_mem_ip' => null,
 'cache_mem_port' => null,
 'cache_memd_ip' => null,
 'debug_page' => 1,
 'uploadimagemax' => 3,
 'uploadfilemax' => 3,
 'token' => '',
			'messview' => 'mess',
			'bucketcdn'=>C("DOMAIN_NAME").'/upload/',/*小图片cdn加速*/
			'imgcdn'=>C("DOMAIN_NAME").'/upload/',/*大图片cdn加速*/
			'icdn'=>'/',/*静态cdn加速*/
			'user_bool'=>1,
			'OSS_ACCESS_ID'=>'',
			'OSS_ACCESS_KEY'=>'',
			'OSS_ENDPOINT'=>'',
			'OSS_BUCKET'=>'',/*阿里云oss配置*/
			'WX_APPID'=>'',
			'WX_AppSecret'=>'',/*阿里云oss配置*/
 );
 if(is_file(CONF_PATH . 'conf.php')){
 $conf = file(CONF_PATH . 'conf.php');
 $this->conf = json_decode($conf[1],true);
 
 $this->conf = array_merge($tmp_conf,$this->conf);
 $GLOBALS['conf'] =$this->conf;
 }else{
 $this->conf = $tmp_conf;
 $GLOBALS['conf'] = $this->conf;
 }
 define('bucketcdn',$this->conf['bucketcdn']);
 define('imgcdn',$this->conf['imgcdn']);
define('icdn',$this->conf['icdn']);
 C("DATA_CACHE_TYPE", $this->conf['cache_type']);
 C("DATA_CACHE_TABLE", $this->conf['cache_table']);
 C("DATA_CACHE_KEY", $this->conf['cache_key']);
 C("DATA_CACHE_TIME", $this->conf['cache_time']);
 C("DATA_CACHE_PREFIX", $this->conf['cache_pr']);
 if ($this->conf['cache_ys'] == 'on') C("DATA_CACHE_COMPRESS", true);
 if ($this->conf['cache_outtime']) C("DATA_CACHE_TIMEOUT", $this->conf['cache_outtime']);
 if ($this->conf['cache_redis_ip']) C("REDIS_HOST", $this->conf['cache_redis_ip']);
 if ($this->conf['cache_redis_port']) C("REDIS_PORT", $this->conf['cache_redis_port']);
 if ($this->conf['cache_mem_ip']) C("MEMCACHE_HOST", $this->conf['cache_mem_ip']);
 if ($this->conf['cache_mem_port']) C("MEMCACHE_PORT", $this->conf['cache_mem_port']);
 if ($this->conf['cache_memd_ip']) {
 $arr = explode("\r\n", $this->conf['cache_memd_ip']);
 $options = array();
 foreach ($arr as $v) {
 array_push($options, explode(":", $v));
 }
 C("MEMCACHED_SERVER", $options);
 }
 $this->v("conf", $this->conf);
 }
 
 protected function die_json($data) {
 if (IS_AJAX && IS_POST) {
 $this->json($data);
 } else {
 if ($data['link']) header('location: ' . $data['link']); header('location: /');
 }
 die();
 }
 protected function message($msg, $code = false, $url = '/') {
 if ((IS_AJAX && IS_POST) or (isset($_GET['YS_ext']) and $_GET['YS_ext'] == 'api')){ if($code) return $this->json(array('code' => $code, 'info' => $msg, 'url' => $url)); else return $this->json(array('code' => 303, 'info' => $msg, 'url' => $url));}
 $this->v('title', $msg);
 $this->v("url", $url);
 $this->v("msg", $msg);
 $this->v("bool", ($code==200)?true:false);
 $this->view = $this->conf['messview'];
 $this->display('index');
 }


public function hashid($content){
$content=geshihua($content);
$hashid=sha1($content).strlen($content);
if(!$data=M('Hash')->read($hashid,$this->CacheObj)) S('hash')->insert(array('hashid'=>$hashid,'content'=>$content));
return $hashid;
}
 public function rnd(){
$rnd=mt_rand(1,4000000);
if($rnd>3999995)  return 1000+mt_rand(1,100);
if($rnd>3999900)  return 500+mt_rand(1,50);
if($rnd>3999000)  return 100+mt_rand(1,10);
if($rnd>3900000)  return 50+mt_rand(1,10);
if($rnd>2990000)  return 20+mt_rand(1,10);
if($rnd>990000)  return 10+mt_rand(1,10);
 return 5+mt_rand(1,10);
 }
 public function check($gold=0){ 
 
  if(!IS_LOGIN){ $this->json(array('code'=>301,'info'=>fy('请登录')));die();}
  if($gold>0 and $this->_user['gold']<$gold) {$this->json(array('code'=>302,'info'=>fy('金币不足')));die();}
}

public function setmate($set) {
 if (isset($set['urlhz'])) $this->v('urlhz',$set['urlhz']);
 if (isset($set['dname'])) $this->v("dname", $set['dname']);
 if (isset($set['m_ca'])) $this->v("m_ca", $set['m_ca']);
 if (isset($set['m_amp'])) $this->v("m_amp", $set['m_amp']);
 if (isset($set['xml'])) $this->v("xml", $set['xml']);
 if (isset($set['title'])) $this->v("title", $set['title']);
 if (isset($set['m_key'])) $this->v("m_key", $set['m_key']);
 if (isset($set['m_des']) and $set['m_des']) $this->v("m_des", $set['m_des']);
 if (isset($set['m_img'])) $this->v("m_img", $set['m_img']); else $this->v("m_img", bucketcdn . 'logo.jpg');
 if (isset($_GET['YS_ext'])) {
if($_GET['YS_ext'] == 'feed'){header("Content-type:text/xml");$this->view = 'rss';}
if($_GET['YS_ext'] == 'api'){header("Content-type:text/json");$this->view = 'api';}
if($_GET['YS_ext'] == 'amp') $this->view = 'amp';
}
 if (isset($set['m_ca'])){
 $btime = isset($set['btime']) ? date(DATE_W3C, $set['btime']) : date(DATE_W3C, NOW_TIME);
 $atime = isset($set['atime']) ? date(DATE_W3C, $set['atime']) : date(DATE_W3C, '1490420398');
 $author = isset($set['author']) ? $set['author'] : 'picadv';
 $name = isset($set['name']) ? $set['name'] : 'picadv';
 $url = isset($set['logo']) ? $set['logo'] : bucketcdn . 'logo.jpg';
 $img = isset($set['m_img']) ? $set['m_img'] : bucketcdn . 'logo.jpg';
 $context = (object)array("@context" => "http://schema.org", "@type" => "BlogPosting", "dateModified" => $btime, "mainEntityOfPage" => $set['m_ca'], "headline" => $set['title'], "datePublished" => $atime, "author" => (object)array("@type" => "Person", "name" => $author), "publisher" => (object)array("@type" => "Organization", "name" => $name, "logo" => (object)array("url" => $url, "@type" => "ImageObject")), "image" => (object)array("url" => $img, "@type" => "ImageObject"));
 $this->v('json', json_encode($context, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
}
}
