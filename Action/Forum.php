<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Forum extends Ysv8 {
    public function __construct(){
		parent::__construct();
		$left_menu = array('index'=>'','forum'=>'active');
		$this->v("left_menu",$left_menu);
	}
public function index(){
$pageid=isset($_GET['YS_URL'][2]) ? intval($_GET['YS_URL'][2]) : 0;
$this->setmate(array('dname'=>'YSPHP',
'm_key'=>fy('板块分类'),
'urlhz'=>'/f.html',
'm_amp'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/index.amp',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/',
'm_des'=>'YSPHP',
'title'=>fy('板块分类'),
'xml'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/index.feed',
));
$this->v("data",M('Forum')->read_list($pageid,10,-1,$this->CacheObj));
$this->display('forum_index');
}

public function _no(){
$fid = 0;
$f=M('Forum');
if(strcmp(intval(METHOD_NAME) , METHOD_NAME) == 0){$fid = intval(METHOD_NAME);
$fdata=$f->read($fid,$this->CacheObj);
}else{//获取id
$fdata=$f->read_name(METHOD_NAME,$this->CacheObj);  
$fid=$fdata['id'];
}
if(!$fdata) return $this->message(fy('没有此分类'));

if(mt_rand(5,25)==20) $f->up_so($fdata,$this->CacheObj);/*随机更新*/


$pageid=isset($_GET['YS_URL'][3]) ? intval($_GET['YS_URL'][3]) : 0;
$mode = isset($_GET['YS_URL'][2]) ? intval($_GET['YS_URL'][2]) : '0';

if(in_array($mode,array(1,2,3))){
$this->setmate(array('dname'=>'YSPHP',
'm_key'=>$fdata['name'],
'urlhz'=>'/f/'.$fid.'.html',
'm_amp'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/'.$fid.'/'.$mode.'.amp',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/',
'm_des'=>'YSPHP',
'title'=>$this->tmode[$mode]. '_'.$fdata['name'].$this->conf['title2'],
'xml'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/'.$fid.'/'.$mode.'.feed',
));

}else{
$this->setmate(array('dname'=>'YSPHP',
'm_key'=>$fdata['name'],
'urlhz'=>'/f/'.$fid.'.html',
'm_amp'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/'.$fid.'.amp',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/',
'm_des'=>'YSPHP',
'title'=>$fdata['name'].$this->conf['title2'],
'xml'=>'//'.NOW_LANG.'.'.DOMAIN.'/f/'.$fid.'.feed',
));

}

$this->v("mode",$mode);
$this->v("data",M('Thread')->read_list($pageid,$this->conf['listnum'],$mode,$fid,0,$this->CacheObj));
$this->v("fdata",$fdata);
$this->v("mode",$mode);
$this->display('forum_thread');
    }

    
}
