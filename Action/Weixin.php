<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Weixin extends Ysv8 {
    public function __construct(){
		parent::__construct();

	}
 public function login(){
  $code = X('get.code');
  if(empty($GLOBALS['conf']['WX_AppSecret']) or  empty($GLOBALS['conf']['WX_APPID']))   return $this->json(['code' => 502, 'msg' => '参数未配置']);
  
  $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $GLOBALS['conf']['WX_APPID'] . "&secret=" . $GLOBALS['conf']['WX_AppSecret'] . "&js_code=" . $code . "&grant_type=authorization_code";
  $arr = $this->vget($url); // 一个使用curl实现的get方法请求
  $arr = json_decode($arr, true);
  $openid = $arr['openid'];
  $session_key = $arr['session_key'];

  
  // 数据签名校验
  $signature = X('get.signature');
  $rawData = X('get.rawData');
  $signature2 = sha1($rawData . $session_key);
  if ($signature != $signature2) {
   return $this->json(['code' => 500, 'msg' => '数据签名验证失败！']);
  }
  $encryptedData = X('get.encryptedData');
  $iv = X('get.iv');
  $pc =  L('Wxdecrypt');
  $pc->set($GLOBALS['conf']['WX_APPID'],$session_key);
  $errCode = $pc->decryptData($encryptedData, $iv, $data); //其中$data包含用户的所有数据
  $data = json_decode($data);
  $weixin=M('Weixin');
  if ($errCode == 0) {
if($data=$weixin->openid($openid,$this->CacheObj)){
$weixin->up($arr,$this->CacheObj);

}else{
$data=$weixin->in($arr);
}
$user=M('User')->read($data['uid'],$this->CacheObj);
$ysv8hex=L("User")->set_cookie($user);
   return $this->json(['ysv8hex' => $ysv8hex,'code' =>200,'gold'=>$user['gold'],'credits'=>$user['credits']]);

  } else {
  return $this->json(['code' => 500, 'msg' => $errCode]);
  }
 }
 
 public function vget($url){
  $info=curl_init();
  curl_setopt($info,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($info,CURLOPT_HEADER,0);
  curl_setopt($info,CURLOPT_NOBODY,0);
  curl_setopt($info,CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($info,CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($info,CURLOPT_URL,$url);
  $output= curl_exec($info);
  curl_close($info);
  return $output;
}

    
}
