<?php
namespace Lib;
class User{ //用户名检查 , 仅允许数字与字母 长度5-18 去前后空
 public function check_user(&$username){
 $username = trim($username);
 $username = strtolower($username);
 if(empty($username)) {
 return fy('不能为空');
 } elseif(mb_strlen($username) > 18 || mb_strlen($username) < 2) {
 return fy('长度不符');
 } elseif(str_replace(array("\t", "\r", "\n", ' ', '　', ',', '，', '-'), '', $username) != $username) {
 return fy('包含特殊字符');
 } elseif(!preg_match('#^[\w\'\-\x7f-\xff]+$#', $username)) {
 return fy('包含标点字符');
 } elseif(htmlspecialchars($username) != $username) {
 return fy('错误').':HTML';
 }
 if(($error = $this->have_badword($username))) {
 return fy('包含敏感词').':'.$error;
 }
 return '';
 }
 public function check_pass($pass){
 if(strlen($pass) < 5)
 return false;
 return true;
 }
 public function check_email(&$email) {
 if(empty($email)) {
 return fy('不能为空');
 } elseif(!preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email)) {
 return fy('格式为空');
 } elseif(mb_strlen($email) < 6) {
 return fy('太短');
 }
 return '';
 }
 public function md5_md5($s, $salt = '') {
 return md5(md5($s).$salt);
 }
public function set_hex($arr){
return L("Encrypt")->encrypt(json_encode($arr),C("MD5_KEY"));
}
public function get_hex($cookie){
$json = L("Encrypt")->decrypt($cookie,C("MD5_KEY"));
return json_decode($json,true);
}

public function set_auth($data){/**/
 $arr=array(
 'id'=>$data['id'],
 'time'=>NOW_TIME,
 'tkid'=>$data['tkid']
 ); 
 return L("Encrypt")->encrypt(json_encode($arr),C("MD5_KEY"));
 }
 public function get_auth($cookie){
 return json_decode(L("Encrypt")->decrypt($cookie,C("MD5_KEY")),true);
 }
 public function set_cookie($data){
 $arr=array(
 'id'=>$data['id'],
 'user'=>$data['user'],
 'time'=>NOW_TIME
 ); 
  return L("Encrypt")->encrypt(json_encode($arr),C("MD5_KEY"));
 }
 public function get_cookie($cookie){
$json = L("Encrypt")->decrypt($cookie,C("MD5_KEY"));
 return json_decode($json,true);
 }
 public function have_badword($user){/*敏感字检测*/
 $badword = explode('|',C('badword'));
 if(empty($badword)) return false;
 foreach($badword as $v) {
 if($v and strpos($user, $v) !== FALSE) return $v;

 }
 return '';
 }
}
