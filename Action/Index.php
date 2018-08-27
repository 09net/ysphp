<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Index extends Ysv8 {
 public function __construct(){
 parent::__construct();

 }
 public function ces(){
 oss('index.html', 'putObject','44api','123456');
 }

public function index(){

$pageid=isset($_GET['YS_URL'][3]) ? intval($_GET['YS_URL'][3]) : 0;
$mode = isset($_GET['YS_URL'][2]) ? intval($_GET['YS_URL'][2]) : '0';
if(in_array($mode,array(1,2,3))){

$this->setmate(array('dname'=>'YSPHP',
'm_key'=>fy($this->conf['keywords']),
'urlhz'=>'/',
'm_amp'=>'//'.NOW_LANG.'.'.DOMAIN.'/index/index/'.$mode.'.amp',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/index/index/'.$mode,
'm_des'=>fy($this->conf['description']),
'title'=>$this->tmode[$mode]. '_'.$this->conf['title2'],
'xml'=>'//'.NOW_LANG.'.'.DOMAIN.'/index/index/'.$mode.'.feed',
));
}else{
$this->setmate(array('dname'=>'YSPHP',
'm_key'=>fy($this->conf['keywords']),
'urlhz'=>'/',
'm_amp'=>'//'.NOW_LANG.'.'.DOMAIN.'/index.amp',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/',
'm_des'=>fy($this->conf['description']),
'title'=>fy($this->conf['title']),
'xml'=>'//'.NOW_LANG.'.'.DOMAIN.'/index.feed',
));
}


$this->v("mode",$mode);
$this->v("data",M('Thread')->read_list($pageid,$this->conf['listnum'],$mode,-1,0,$this->CacheObj));
 $this->display('index_index');
 }

}
