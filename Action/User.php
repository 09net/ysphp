<?php
namespace Action;
use YS\Action;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class User extends Ysv8 {
 public $menu_action;
 public function __construct(){
 parent::__construct();
$this->menu_action = array('index'=>'','thread'=>'','post'=>'','mess'=>'','op'=>'','file'=>'','favour'=>'','weibo'=>'','ads'=>'active');
 $this->v('menu_action',$this->menu_action);
 }
 public function _no(){
 header("location: /");
 exit;
 }
 public function my(){
 }
 

 public function cse(){ 
 $all=0;
 for ($x=0; $x<=500; $x++) {
 $rnd=$this->rnd();
 $all+=$rnd*10;
 echo $rnd*10,'<br>';
 }
 echo $all/501;
 
 }
public function tixian(){
        $this->check();
if($this->_user['gold']<38888){
return $this->json(array('info'=>fy('金币不足'),'code'=>302));
}
if(!M('User')->up_int(NOW_UID,array('gold[-]'=>38888,'credits[+]'=>5),$this->CacheObj)) return $this->json(array('info'=>fy('未知错误'),'code'=>500));
S('tixian')->insert(array('uid'=>NOW_UID,'gold'=>38888,'atime'=>NOW_TIME,'mode'=>0));
return $this->json(array('info'=>fy('提现成功'),'code'=>200,'gold'=>$this->_user['gold']-38888,'credits'=>$this->_user['credits']+5));
} 

public function qiandao(){
        $this->check();

$rnd=$this->rnd();
$gold=$rnd*10;
$data=date("Y/n/j");
$atime=M('Qiandao')->read(NOW_UID,$this->CacheObj);
if($atime!=$data){
M('User')->up_int(NOW_UID,array('gold[+]'=>$gold,'credits[+]'=>5),$this->CacheObj);
if($atime===false)
M('Qiandao')->insert(array('uid'=>NOW_UID,'num'=>1,'atime'=>$data));
else
M('Qiandao')->up_int(NOW_UID,array('num[+]'=>1,'atime'=>$data),$this->CacheObj);
setcookie('qiandao', $data, NOW_TIME+864000,'/',DOMAIN);
return $this->json(array('info'=>$gold,'rnd'=>$rnd,'code'=>200,'gold'=>$this->_user['gold']+$gold,'credits'=>$this->_user['credits']+5,'data'=>$data));
}else{
setcookie('qiandao', $data, NOW_TIME+864000,'/',DOMAIN);
return $this->json(array('info'=>fy('今日已领'),'code'=>504,'gold'=>$this->_user['gold'],'credits'=>$this->_user['credits'],'data'=>$data));
}

}
 
 //消息跳转 设置已读 
 public function mess(){
$this->check();
$id = intval(X("get.id") );
if(empty($id))return $this->message(fy('参数不完整'),501,'/');
$Mess = M("Mess");
$data = $Mess->read($id,$this->CacheObj);
if(empty($data)) return $this->message(fy('不存在该消息'),400,'/');
if($data['uid'] != $this->_user['id']) return $this->message(fy('这条消息不属于你'),502,'/');
if(!$data['view']){
$Mess->up_int($id,array('view'=>1),$this->CacheObj);
M("User")->up_int($data['uid'],array('mess[-]'=>1));
}
header('location: /t/'.$data['tid'].'.html');
exit;
}
 public function Edit(){
        $this->check();
  $gn = X('post.gn');
        if($gn == 'ps'){
            $ps = htmlspecialchars(strip_tags(X("post.ps")));
            if(!empty($ps)){
			 M("User")->up_int(NOW_UID,array( 'ps'=>$ps),$this->CacheObj);
                
                return $this->message(fy('保存成功'),200,'/');
            }
        }elseif($gn == 'pass'){
            $pass0 = X("post.pass0");
            $pass1 = X("post.pass1");
            $pass2 = X("post.pass2");
            if($pass1 != $pass2)
                return $this->message(fy('两次密码不一致'),501,'/');
            $UserLib = L("User");
            if(!$UserLib->check_pass($pass1))
                return $this->message(fy('密码不符合规则'),501,'/');
            if($UserLib->md5_md5($pass0,$this->_user['salt']) != $this->_user['pass'])
                return $this->message(fy('原密码不正确'),501,'/');
            $newpass = $UserLib->md5_md5($pass1,$this->_user['salt']);
            $this->_user['pass'] = $newpass;
				 M("User")->up_int(NOW_UID,array('pass'=>$this->_user['pass']),$this->CacheObj);
			
            cookie('YSPHP_HEX',$UserLib->set_cookie($this->_user));
            return $this->message(fy('修改成功'),200,'/');
        }

        
        return $this->message(fy('提交出错'),500,'/');
 
 
}

 public function edit_muser(){
$quhao=X("post.quhao");
$mobile=X("post.mobile");
$app=X("post.app");
$zhanghao=X("post.zhanghao");
$dz=X("post.dz");
$muser=M('Muser');
if($muser->read(NOW_UID,$this->CacheObj)){
$muser->update(array('quhao'=>$quhao,'mobile'=>$mobile,'app'=>$app,'zhanghao'=>$zhanghao,'dz'=>$dz),array('uid'=>NOW_UID));
}else{
$muser->insert(array('quhao'=>$quhao,'mobile'=>$mobile,'app'=>$app,'zhanghao'=>$zhanghao,'dz'=>$dz,'uid'=>NOW_UID));
}
return $this->message(fy('修改成功'),200,'/u/'.urlencode($this->_user['user']).'/op.html');
}
public function edit_pw(){
$pass1 = X("post.pass1");
$pass2 = X("post.pass2");
if($pass1 != $pass2)
return $this->message(fy('两次密码不一致'),501,'/u/'.urlencode($this->_user['user']).'/op.html');
$UserLib = L("User");
if(!$UserLib->check_pass($pass1))
return $this->message(fy('密码不符合规则'),501,'/u/'.urlencode($this->_user['user']).'/op.html');
$newpass = $UserLib->md5_md5($pass1,$this->_user['salt']);
$this->_user['pass'] = $newpass;
S("User")->update(array('pass'=>$this->_user['pass']),array('id'=>$this->_user['id']));
cookie('YSPHP_HEX',$UserLib->set_cookie($this->_user));
return $this->message(fy('修改成功'),200,'/u/'.urlencode($this->_user['user']).'/op.html');
}
public function repass(){
 $this->v("title",fy('找回密码'));
if(IS_LOGIN) return $this->message(fy('已经登录'),505,'/');
$this->display('user_repass');
 }
 public function recode2(){
 $email = X("post.email");
 $code = strtoupper(X("post.code"));
 $pass1=X("post.pass1");
 $pass2=X("post.pass2");
 if(empty($email)||empty($code)||empty($pass1)||empty($pass2))
 $this->json(array('code'=>501,'info'=>fy('参数不完整,请填写好表单!')));
 if($pass1 != $pass2)
 $this->json(array('code'=>501,'info'=>fy('确认密码不一致')));
 $UserLib = L("User");
 if(!$UserLib->check_pass($pass1))
 $this->json(array('code'=>501,'info'=>fy('新密码不符合规则,必须大于等于5位')));
 $User = M("User");

 if(!$User->is_email($email))
 $this->json(array('code'=>501,'info'=>fy('邮箱不存在')));
 $data = $User->email_read($email,$this->CacheObj);
 if(empty($data))
 $this->json(array('code'=>501,'info'=>fy('邮箱不存在')));
 if(strlen($code) != 6)
 $this->json(array('code'=>200,'info'=>fy('验证码是6位的')));
 $cookie = cookie("YS_EMAIL");
 if(empty($cookie))
 $this->json(array('code'=>501,'info'=>fy('验证码已经过期,请24小时后再来修改密码,紧急请联系管理员.')));
 $Encrypt = L("Encrypt");
 $cr = $Encrypt->decrypt($cookie,$data['salt'].C("MD5_KEY"));
 if($cr != $code)
 $this->json(array('code'=>501,'info'=>fy('验证码错误')));
 $User->update(array('pass'=>L("User")->md5_md5($pass1,$data['salt'])),array('id'=>$data['id']));
 cookie('YS_EMAIL',null);
 $this->json(array('code'=>200,'info'=>fy('修改成功')));
 }
 public function recode(){
 $email = X("post.email");
 $emailhost = $this->conf['emailhost'];
 $emailport = $this->conf['emailport'];
 $emailuser = $this->conf['emailuser'];
 $emailpass = $this->conf['emailpass'];
 if(empty($emailhost) || empty($emailport))
 $this->json(array('code'=>500,'info'=>fy('网站没开启邮箱功能,请联系网站管理员')));
 $User = M("User");
 if(!$User->is_email($email))
 $this->json(array('code'=>501,'info'=>fy('该邮箱不存在')));
 $data = M("User")->email_read($email,$this->CacheObj);
 if(empty($data))
 $this->json(array('code'=>501,'info'=>fy('该邮箱不存在')));
 if($data['etime'] > NOW_TIME)
 $this->json(array('code'=>504,'info'=>fy('24小时你只允许发送一次验证码')));
 $code = rand_code(6);
 $Email = L("Email");
 $Encrypt = L("Encrypt");
 $Email->init($emailhost,$emailport,true,$emailuser,$emailpass);
 if(!$Email->sendmail($email,$emailuser,$this->conf['emailtitle'],'验证码:'.$code.$this->conf['emailcontent'],'HTML'))
 $this->json(array('code'=>500,'info'=>'发送失败,具体原因:'.$Email->error_mess));
 cookie('YS_EMAIL',$Encrypt->encrypt($code,$data['salt'].C("MD5_KEY")),300); //有效期5分钟
 $User->update(array('etime'=>NOW_TIME+86400),array('id'=>$data['id']));
 $this->json(array('code'=>200,'info'=>fy('发送成功!')));
 

 }
 public function Pwcheck(){
if(!IS_LOGIN){die($this->json(array('code'=>301,'info'=>fy('请登录'))));}
if(!IS_POST){die($this->json(array('code'=>503,'info'=>fy('非法请求'))));}
$pw=X('post.pw');
$data =S('User')->find("*",array('id'=>$this->_user['id']));
 $UserLib = L("User");
if($data['pass'] == $UserLib->md5_md5($pw,$data['salt'])){
die($this->json(array('code'=>200,'info'=>fy('正确'))));
}else{
die($this->json(array('code'=>500,'info'=>fy('错误'))));
}
}
 public function Login(){
 $this->v("title",fy('登录页面'));
 if(IS_LOGIN){header("Location:/");die();}

 if(IS_GET){
 $re_url = X("server.HTTP_REFERER");
 if(strpos($re_url,DOMAIN)!= -1 && strpos($re_url,'/user')===false)
 cookie('re_url',$re_url);
 $this->display('user_login');
 }elseif(IS_POST){
 $user = X("post.user");
 $pass = X("post.pass");
 $UserLib = L("User");
  $User = M("User");
 if($UserLib->check_email($user)==''){
if($udata=$User->email_read($user,$this->CacheObj)) $user=$udata['user']; else return $this->message(fy("邮箱不存在"),501,'/user/Login');
 }else{
 $msg = $UserLib->check_user($user); if(!empty($msg)) return $this->message($msg,false,'/user/Login');
}
 $data =$User->user_read($user,$this->CacheObj);
 if(empty($data))  return $this->message(fy('用户名不存在'),501,'/user/Login');
 //密码正确
 if($data['pass'] != $UserLib->md5_md5($pass,$data['salt'])) return $this->message(fy("密码错误"),501,'/user/Login');
 
 if($_GET['YS_ext'] == 'api') return $this->json(array('code'=>200,'hex'=>$UserLib->set_cookie($data)));
 
 $Friend = S("Friend");
 $sum = $Friend->sum("c",array('uid1'=>$data['id']));
 M("Chat_count")->update(array('c'=>$sum),array('uid'=>$data['id']));
 cookie('YSPHP_HEX',$UserLib->set_cookie($data));
 $this->init_user();
 $re_url = cookie('re_url');
 cookie('re_url',null);
 return $this->message(fy("登录成功"),200,$re_url);
 }
 }
 //获取用户信息
  public function get(){
  $this->check();
return $this->json(array('code'=>200,'my'=>$this->_user,'forum'=>$this->_forum));
  
  }
 public function Add(){

 $this->v("title",fy('注册用户'));
 if(IS_LOGIN) return $this->message(fy('已登录'),505,'/user/add');
 if(IS_GET){
 $re_url = X("server.HTTP_REFERER");
 
 if(strpos($re_url,DOMAIN)!= -1 && strpos($re_url,'/user')===false)
 cookie('re_url',$re_url);
$this->v("upuid",intval(cookie("YSV8_UPUID")));
$this->display('user_add');
 }
 elseif(IS_POST){
 $user = X("post.user");
 $pass1 = X("post.pass");
 $pass2 = X("post.pass2");
 $email = X("post.email");
$upuid = intval(X("post.upuid"));
 if($pass1 != $pass2)
 return $this->message(fy('两次密码不一致'),501,'/user/add');

 $UserLib = L("User");
 $msg = $UserLib->check_user($user);
 //检查用户名格式是否正确
 if(!empty($msg))
 return $this->message($msg);

 if(!$UserLib->check_pass($pass1))
 return $this->message(fy('密码不符合规则'),501,'/user/add');
 $msg = $UserLib->check_email($email);
 if(!empty($msg))
 return $this->message($msg);
 $User = M("User");
 if($User->is_user($user))
 return $this->message(fy('账号已经存在'),501,'/user/add');

 if($User->is_email($email))
 return $this->message(fy('邮箱已经存在'),501,'/user/add');
 if(!$id=$User->add_user($user,$pass1,$email,$upuid)) return $this->message(fy('未知错误'),500,'/user/add');
    if($_GET['YS_ext'] == 'api') return $this->json(array('code'=>200,'hex'=>$UserLib->set_cookie(array('id'=>$id,'user'=>$user))));
 cookie('YSPHP_HEX',$UserLib->set_cookie(array('id'=>$id,'user'=>$user)));
 $re_url = cookie('re_url');
 cookie('re_url',null);
 return $this->message(fy('账号注册成功'),200,$re_url);
 }
 }
 //上传头像
 public function ava(){
 $this->v("title",fy('更改头像'));
$this->check();
 $id = $this->_user['id'];
 if(empty($id)) return $this->message(fy('请重新登录'),301,'/user/login');
 
  $upload = new \Lib\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('jpg', 'bmp', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     INDEX_PATH. "upload/"; 

        $upload->replace    =   true;
        $upload->autoSub    =   false;
        if(!is_dir(INDEX_PATH. "upload")) mkdir(INDEX_PATH. "upload");
        $info   =   $upload->upload();
        if(!$info)return $this->message(fy('上传失败'),500,'/user/ava');

 M("User")->up_int(NOW_UID,array('avatar'=>$info['photo']['savename']),$this->CacheObj);
 return $this->message(fy('上传成功'),200,'/user/ava');

 }
 public function out(){
 if(!IS_LOGIN) $this->message(fy('退出成功'),200,'/user/login');
 $this->v("title",fy('注销用户'));
 cookie('YSPHP_HEX',null);
 $this->init_user();
 $re_url = X("server.HTTP_REFERER");
 if(strpos($re_url,DOMAIN)!= -1 && strpos($re_url,'/user')===false)
 return header("location: ".$re_url);
 $this->message(fy('退出成功'),200,$re_url);
 }

}
