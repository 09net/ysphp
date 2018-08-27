<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Fy extends Ysv8 {
public function __construct(){
parent::__construct();
}

public function index(){
$fy=array('请重新提交','登录','成功','发送','上传失败','失败','新消息','签名','关注','取消','收藏','选择','图片','视频','文档','军事','社会','娱乐','搞笑','经济','政治','科技','体育','奇闻','情感','娱乐','文化','家庭','两性','历史','登录','退出','色情','谣言','诈骗','极端','确定','删除','退出');
$fy=array_unique($fy);
echo 'var l={';
foreach ($fy as $value) echo '\'',$value,'\':\'',fy($value),'\',';
echo '}';
}
public function _no(){
return $this->json(["error"=>true,"info"=>fy(METHOD_NAME)]);
}




	
	
}
