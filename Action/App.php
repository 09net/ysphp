<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class App extends Ysv8 {
    public function __construct(){
		parent::__construct();

	}
public function index(){
if(IS_SHOUJI){
header('Location: /mui/index.html');
exit;
}
$this->setmate(array('dname'=>'YSPHP',
'm_key'=>fy('手机客户端下载'),
'urlhz'=>'/app/index.html',
'm_ca'=>'//'.NOW_LANG.'.'.DOMAIN.'/app/index.html',
'm_des'=>'YSPHP',
'title'=>fy('手机客户端下载').'_app'
));
$this->display('app_index');
}


    
}
