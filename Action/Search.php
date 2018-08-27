<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Search extends Ysv8 {
    public function __construct() {
		parent::__construct();
            }
    public function _no(){
                $this->index(isset($_GET['YS_URL'][1]) ? $_GET['YS_URL'][1] : '');
    }
    public function index($q=''){
if($q=='') $q = X("get.q");
$mode = isset($_GET['YS_URL'][2]) ? $_GET['YS_URL'][2] : X("get.mode",0);
$fid = X("get.fid");
if(empty($q)) $q='ysphp';
$q = htmlspecialchars($q);
$this->v("q",$q);
$this->v("mode",$mode);
$this->v("fid",$fid);
$pageid=intval(X('get.pageid')) or $pageid=0;
$keyword=M('Mykey')->get_key($q,$this->CacheObj,1);
$this->v('user_list',M('User')->search_list($pageid,$this->conf['listnum'],$keyword,$this->CacheObj));
$this->v('forum_list',M('Forum')->search_list($pageid,$this->conf['listnum'],$keyword,$this->CacheObj));
$this->v("pageid",$pageid);
if(in_array($mode,array(1,2,3))) $keyword[0]='+mode'.$mode.' '.$keyword[0];
if(is_numeric($fid) and $fid>0) $keyword[0]='+fid'.$fid.' '.$keyword[0];
$this->v("data", M('Thread')->search_list_44api($pageid,$this->conf['listnum'],$keyword,$this->CacheObj));
if(in_array($mode,array(1,2,3))){
$this->setmate(array(
 'dname' => fy('搜索'),
 'm_key' => $q ,
'm_ca' => '//' . NOW_LANG . '.'.DOMAIN.'/search/' . urlencode($q) . '/'.$mode.'.html',
 'title' => $q.'_'.fy('搜索'). '_' . $this->tmode[$mode],
 ));
 }else{
 
 $this->setmate(array(
 'dname' => fy('搜索'),
 'm_key' => $q ,
'm_ca' => '//' . NOW_LANG . '.'.DOMAIN.'/search/' . urlencode($q) . '.html',
 'title' => $q.'_'.fy('搜索'),
 ));
 }
$this->display('search_index');
    }
    }
