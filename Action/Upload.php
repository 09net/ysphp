<?php
// +------------------------------------------+
// | YSPHP 44api.com                          |
// +------------------------------------------+
// | Copyright (c) 1997-2004 The 09hnnet      |
// +------------------------------------------+
// | 图片缩微图生成，版权所有，不允许用于商业目的   |
// +------------------------------------------+
// | 购买授权  09hnnet <719048503@qq.com>      |
// +------------------------------------------+
namespace Action;use YS\Action;!defined('YS_PATH')&&exit('YS_PATH not defined.');
class Upload extends Ysv8 {
public function __construct() {
parent::__construct();
}
public function _no() {
$imga = explode('_', $_GET['s']);
if(count($imga)!=2) return false;
if(!is_file(INDEX_PATH.$imga[0]))  return false;
$image=L('Image');
$image=$image->open(INDEX_PATH.$imga[0]);
header('Content-type: '.$image->mime());
$image=$image->thumb($imga[1], $imga[1],6)->save(NULL);

}
}