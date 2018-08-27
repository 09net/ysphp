<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class No extends Ysv8 {
    public function __construct(){
	 parent::__construct();
       $this->view = 'meta';
    }
    public function index(){
            header('HTTP/1.1 404 Not Found');
            header('status: 404 Not Found');
         $this->display('404');
    }
    public function _no(){
            header('HTTP/1.1 404 Not Found');
            header('status: 404 Not Found');
            $this->display('404');
    }
}