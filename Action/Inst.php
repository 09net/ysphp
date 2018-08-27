<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
use PDO;

class Inst extends Action {
 public $state;
 private function app_text($str){
 $this->state.='<p><i class="fa fa-check"></i> '.$str.'</p>';
 }
 
 public function install(){
 die('install');
 }
 public function rex(){
 $DOMAIN_NAME = C('SQL_NAME');
 
 if(!empty($DOMAIN_NAME)){
 if(IS_AJAX)
 $this->json(array('error'=>false,'info'=>'你已经安装过,如果需要重装请将 /Conf/config.php删除'));
 else
 die('你已经安装过,如果需要重装请将 /Conf/config.php删除');
 }
 $bbs_user = X('post.bbs_user');
 $bbs_pass = X('post.bbs_pass');
 $email = X('post.email');
 $www = X('post.www');
 !empty($bbs_user) or $this->json(array('error'=>false,'info'=>'请输入管理员用户名'));
 !empty($bbs_pass) or $this->json(array('error'=>false,'info'=>'请输入管理员密码 (最少6位)'));
 !empty($email) or $this->json(array('error'=>false,'info'=>'请输入管理员邮箱'));
 !empty($www) or $this->json(array('error'=>false,'info'=>'请输入网站域名'));


 
 return $sql = new \YS\Lib\Medoo(array(
 // 必须配置项
 'database_type' => X("post.sqltype"),
 'database_name' => X("post.name"),
 'server' => X("post.ip"),
 'username' => X("post.username"),
 'password' => X("post.password"),
 'charset' => 'utf8',
 // 可选参数
 'port' => X("post.port"),
 // 可选，定义表的前缀
 'prefix' => X("post.prefix"),
 ));
 }
 public function index(){
 $sql = $this->rex();
 $table_type = X("post.table_type");
$gn = X('post.gn');
$pre=X("post.prefix");

if($gn == 1){
 $salt = substr(md5(mt_rand(10000000, 99999999).NOW_TIME), 0, 8);
 $result = $sql->query("
DROP TABLE IF EXISTS ".$pre."cache;
DROP TABLE IF EXISTS ".$pre."fycache;
DROP TABLE IF EXISTS ".$pre."chat;
DROP TABLE IF EXISTS ".$pre."chat_count;
DROP TABLE IF EXISTS ".$pre."count;
DROP TABLE IF EXISTS ".$pre."comment;
DROP TABLE IF EXISTS ".$pre."mess;
DROP TABLE IF EXISTS ".$pre."mykey;
DROP TABLE IF EXISTS ".$pre."file;
DROP TABLE IF EXISTS ".$pre."filegold;
DROP TABLE IF EXISTS ".$pre."fileinfo;
DROP TABLE IF EXISTS ".$pre."forum;
DROP TABLE IF EXISTS ".$pre."forum_group;
DROP TABLE IF EXISTS ".$pre."friend;
DROP TABLE IF EXISTS ".$pre."log;
DROP TABLE IF EXISTS ".$pre."online;
DROP TABLE IF EXISTS ".$pre."post;
DROP TABLE IF EXISTS ".$pre."qiandao;
DROP TABLE IF EXISTS ".$pre."thread;
DROP TABLE IF EXISTS ".$pre."tixian;
DROP TABLE IF EXISTS ".$pre."threadgold;
DROP TABLE IF EXISTS ".$pre."user;
DROP TABLE IF EXISTS ".$pre."usergroup;
DROP TABLE IF EXISTS ".$pre."vote_post;
DROP TABLE IF EXISTS ".$pre."vote_thread;
DROP TABLE IF EXISTS ".$pre."weixin;


CREATE TABLE `".$pre."cache` (
  `cachekey` varchar(255) NOT NULL,
  `expire` int(11) NOT NULL,
  `data` blob,
  `datacrc` int(32) DEFAULT NULL,
  UNIQUE KEY `cachekey` (`cachekey`)
) ENGINE={$table_type} DEFAULT CHARSET=utf8;

CREATE TABLE `".$pre."fycache` (
  `cachekey` varchar(255) NOT NULL,
  `expire` int(11) NOT NULL,
  `data` blob,
  `datacrc` int(32) DEFAULT NULL,
  UNIQUE KEY `cachekey` (`cachekey`)
) ENGINE={$table_type} DEFAULT CHARSET=utf8;

CREATE TABLE `".$pre."chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid1` int(10) unsigned NOT NULL,
  `uid2` int(10) unsigned NOT NULL,
  `content` tinytext NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid1` (`uid1`,`uid2`,`id`) USING BTREE
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

 CREATE TABLE `".$pre."chat_count` (
  `uid` int(10) unsigned NOT NULL,
  `c` int(10) unsigned NOT NULL DEFAULT '0',
  `atime` int(10) unsigned NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE={$table_type} DEFAULT CHARSET=utf8;

CREATE TABLE `".$pre."comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `hashid` varchar(80) NOT NULL,
  `atime` int(10) NOT NULL,
  `btime` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  `lang` char(3) DEFAULT 'zh',
  `goods` int(10) DEFAULT '0',
  `posts` int(10) DEFAULT '0',
  `nos` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`btime`),
  KEY `tid` (`tid`,`btime`),
  KEY `uid` (`uid`,`btime`),
  KEY `lang` (`lang`,`btime`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(128) NOT NULL,
  `md5name` varchar(80) NOT NULL,
  `filesize` int(10) unsigned NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  `lang` char(3) DEFAULT 'zh',
  `btime` int(10) DEFAULT NULL,
  `ext` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`,`uid`) USING BTREE,
  UNIQUE KEY `uq` (`md5name`),
  KEY `uid` (`uid`,`btime`),
  KEY `lang` (`lang`,`btime`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."filegold` (
  `uid` int(10) unsigned NOT NULL,
  `fileid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`fileid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."fileinfo` (
  `fileid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `gold` int(10) unsigned NOT NULL,
  `hide` tinyint(1) unsigned NOT NULL,
  `downs` int(10) unsigned NOT NULL,
  `mess` text NOT NULL,
  PRIMARY KEY (`fileid`) USING BTREE,
  KEY `tid` (`tid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."forum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL DEFAULT '-1',
  `fgid` int(10) unsigned NOT NULL DEFAULT '1',
  `name` varchar(12) NOT NULL,
  `name2` varchar(18) NOT NULL,
  `threads` int(10) unsigned NOT NULL DEFAULT '0',
  `posts` int(10) unsigned NOT NULL DEFAULT '0',
  `forumg` text NOT NULL,
  `json` text NOT NULL,
  `html` longtext NOT NULL,
  `color` varchar(30) NOT NULL,
  `background` varchar(30) NOT NULL,
  `lang` char(3) DEFAULT 'zh',
  `atime` int(10) DEFAULT NULL,
  `btime` int(10) DEFAULT NULL,
  `so` varchar(255) DEFAULT '',
  `img` varchar(80) DEFAULT 'de.png',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name2` (`name2`),
  KEY `fid` (`fid`),
  KEY `lang` (`lang`,`btime`),
  FULLTEXT KEY `so` (`so`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
INSERT INTO `".$pre."forum` (`id`, `fid`, `name`,`name2`, `threads`) VALUES (1, -1, 'default','morenfenlei', 0);

CREATE TABLE `".$pre."forum_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `".$pre."friend` (
  `uid1` int(10) unsigned NOT NULL,
  `uid2` int(10) unsigned NOT NULL,
  `c` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `atime` int(10) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid1`,`uid2`) USING BTREE,
  KEY `uid2` (`uid2`,`state`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;

CREATE TABLE `".$pre."log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `gold` int(10) NOT NULL,
  `credits` int(10) unsigned NOT NULL,
  `content` varchar(32) NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."mess` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `view` tinyint(1) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `mode` tinyint(1) NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `view` (`view`,`uid`,`id`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."mykey` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mykey` varchar(25) NOT NULL,
  `size` tinyint(3) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sid` int(10) NOT NULL DEFAULT '0',
  `fid` int(11) NOT NULL DEFAULT '0',
  `ai` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mykey` (`mykey`),
  KEY `pid` (`pid`),
  KEY `size` (`size`)
) ENGINE={$table_type} AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."online` (
  `uid` int(10) unsigned NOT NULL,
  `user` char(18) NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) NOT NULL,
  `mode` char(4) NOT NULL,
  `w` smallint(6) NOT NULL,
  `h` smallint(6) NOT NULL,
  `atime` int(10) NOT NULL,
  `btime` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `likes` int(10) NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '',
  `posts` int(10) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `fid` int(10) NOT NULL,
  `lang` char(3) NOT NULL DEFAULT 'zh',
  `so` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `hash` (`hash`),
  KEY `uid` (`uid`,`btime`) USING BTREE,
  KEY `f` (`fid`,`mode`,`btime`) USING BTREE,
  KEY `lang` (`lang`,`mode`,`btime`) USING BTREE,
  KEY `fid` (`fid`,`btime`) USING BTREE,
  KEY `lang_2` (`lang`,`btime`) USING BTREE
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL,
  `content` longtext NOT NULL,
  `hashid` varchar(80) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hashid` (`hashid`),
  KEY `tid` (`tid`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."qiandao` (
  `uid` int(10) NOT NULL,
  `num` int(10) NOT NULL,
  `atime` varchar(10) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `pid` varchar(80) NOT NULL DEFAULT '0',
  `title` char(128) NOT NULL,
  `summary` text NOT NULL,
  `atime` int(10) unsigned NOT NULL DEFAULT '0',
  `btime` int(10) unsigned NOT NULL DEFAULT '0',
  `buid` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `posts` int(10) unsigned NOT NULL DEFAULT '0',
  `goods` int(10) unsigned NOT NULL DEFAULT '0',
  `nos` int(10) unsigned NOT NULL DEFAULT '0',
  `img` text NOT NULL,
  `top` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `gold` int(10) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mode` tinyint(1) DEFAULT NULL,
  `vs` varchar(128) DEFAULT NULL,
  `files` varchar(32) DEFAULT NULL,
  `lang` char(3) DEFAULT 'zh',
  `so` varchar(255) DEFAULT '',
  `keys` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `uid` (`uid`,`btime`) USING BTREE,
  KEY `fid` (`fid`,`btime`) USING BTREE,
  KEY `top` (`lang`,`top`) USING BTREE,
  FULLTEXT KEY `so` (`so`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."threadgold` (
  `uid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`tid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."tixian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gold` int(10) NOT NULL,
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `atime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`id`) USING BTREE,
  KEY `mode` (`mode`,`id`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(18) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salt` varchar(8) NOT NULL,
  `threads` int(10) unsigned NOT NULL,
  `posts` int(10) unsigned NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  `group` smallint(2) unsigned NOT NULL DEFAULT '0',
  `gold` int(10) NOT NULL DEFAULT '0',
  `credits` int(10) NOT NULL DEFAULT '0',
  `etime` int(10) unsigned NOT NULL DEFAULT '0',
  `ps` varchar(40) DEFAULT '',
  `fans` int(10) unsigned NOT NULL DEFAULT '0',
  `follow` int(10) unsigned NOT NULL DEFAULT '0',
  `btime` int(10) unsigned NOT NULL DEFAULT '0',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0',
  `chat_size` int(10) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT 'user.png',
  `upuid` int(10) DEFAULT NULL,
  `lang` char(3) DEFAULT 'zh',
  `so` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `gid` (`group`),
  KEY `lang` (`lang`,`btime`),
  FULLTEXT KEY `so` (`so`)
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

 INSERT INTO `".$pre."user` (`id`, `user`, `pass`, `email`, `salt`, `threads`, `posts`, `atime`, `btime`, `group`) VALUES
 (1, '".X("post.bbs_user")."', '".L("User")->md5_md5(X("post.bbs_pass"),$salt)."', '".X("post.email")."', '".$salt."', 0, 0, ".NOW_TIME.", ".NOW_TIME.", 9);

 -- --------------------------------------------------------

 CREATE TABLE `".$pre."usergroup` (
  `id` int(10) unsigned NOT NULL,
  `credits` int(11) NOT NULL DEFAULT '-1',
  `space_size` int(10) unsigned DEFAULT '4294967295',
  `chat_size` int(10) unsigned NOT NULL DEFAULT '4294967295',
  `name` varchar(12) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;

 INSERT INTO `".$pre."usergroup` (`id`, `space_size`, `chat_size`, `name`) VALUES
 (1, 4294967295, 4294967295, 'Blacklist'),
 (2, 4294967295, 4294967295, 'Tourist'),
(3, 4294967295, 4294967295, 'Newuser'),
(4, 4294967295, 4294967295, 'AE1'),
(5, 4294967295, 4294967295, 'AE2'),
(6, 4294967295, 4294967295, 'AE3'),
(7, 4294967295, 4294967295, 'AE4'),
(8, 4294967295, 4294967295, 'AE5'),(9, 4294967295, 4294967295, 'Administrator');
CREATE TABLE `".$pre."vote_post` (
  `uid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `atime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`pid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."vote_thread` (
  `uid` int(10) NOT NULL,
  `tid` int(10) NOT NULL,
  `atime` int(10) NOT NULL,
  PRIMARY KEY (`uid`,`tid`) USING BTREE
) ENGINE={$table_type} DEFAULT CHARSET=utf8;
CREATE TABLE `".$pre."weixin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` varchar(32) NOT NULL,
  `btime` int(10) unsigned NOT NULL,
  `openid` varchar(30) NOT NULL,
  `uid` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`) USING BTREE
) ENGINE={$table_type} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
 if($result->errorCode() ==0)
 $this->json(['error'=>true,'info'=>'创建数据表完成']);
 else
 $this->json(['error'=>false,'info'=>$result->errorInfo()[2]]);
}
if($gn == 2){
$this->json(array('error'=>true,'info'=>'创建索引完成'));
}
if($gn == 3){ 
 $content = @file_get_contents(INDEX_PATH . 'Conf/config.back');
 if($content === false)
 $this->json(array('error'=>false,'info'=>'/Conf无读取权限'));
 $str = rand_str(16);
 $content = str_replace(array(
 'MYSQL_NAME',
 'MYSQL_IP',
 'MYSQL_USER',
 'MYSQL_PASS',
 'MYSQL_PORT',
 'MYDOMAIN',
 'sql_typee',
 'MD5_VALUE',
 'SQL_STORAGE_ENGINE_VALUE',
'MYSQL_prefix'
 ),
 array(
 X("post.name"),
 X("post.ip"),
 X("post.username"),
 X("post.password"),
 X("post.port"),
 trim(X("post.www"),'/'),
 X("post.sqltype"),
 $str,
 $table_type,
 X("post.prefix")
 ),$content
 );
 if(@file_put_contents(INDEX_PATH . 'Conf/config.php',$content) === false)
 $this->json(array('error'=>false,'info'=>'/Conf无写入权限'));
 $this->json(array('error'=>true,'info'=>'创建AUTO_INCREMENT完成','url'=>trim(X("post.www"),'/') . '/?s='));
}
 }

}
