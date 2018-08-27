<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Key_pic extends Model {

private $sqlme	=array('id','kid','aid','sid','hashid','vs');

public function read_k_list($id,$xid,$mcache=false,$sid=0){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10));
if($xid==-1){
if($sid>0){
if(is_numeric($id)){$data['AND']=array('kid'=>$id,'sid[<]'=>$sid);}else{$data['AND']=array('kid'=>explode(' ',$id),'sid[<]'=>$sid);}
}else{
if(is_numeric($id)){$data['kid']=$id;}else{$data['kid']=explode(' ',$id);}
}}else{


if(is_numeric($id)){$data['AND']=array('kid'=>$id,'xid'=>$xid);}else{$data['AND']=array('kid'=>explode(' ',$id),'xid'=>$xid);}
if($sid>0) $data['AND']['sid[<]']=$sid;


}


if($mcache==false){
return $this->format($this->select($this->sqlme,$data));
}else{
$data2=$mcache->get('pKakl'.$sid.'_'.$id.'_'.$xid);
if(empty($data2)){$data2=$this->format($this->select($this->sqlme,$data));if($data2)$mcache->set('pKakl'.$sid.'_'.$id.'_'.$xid,$data2);}
}
return $data2;
 } 

 
public function format($thread_list,$mcache=false){
 if(empty($thread_list))
 return;
 static $user_tmp = array();
 $User=M('Mykey');
 $hash=M('Hash');
 $data=array();
 foreach ($thread_list as $v){
 if(empty($v) or isset($data[$v['id']])){
 /*防止重复*/
 }else{
 $data[$v['id']]=array();
 if(empty($user_tmp[$v['kid']]))
 $user_tmp[$v['kid']] = $User->read($v['kid'],$mcache);
 $data[$v['id']]['kname'] = $user_tmp[$v['kid']];
  if(empty($user_tmp[$v['aid']]))
 $user_tmp[$v['aid']] = $User->read($v['aid'],$mcache);
 $data[$v['id']]['aname'] = $user_tmp[$v['aid']];
if(empty($user_tmp[$v['hashid']])) $user_tmp[$v['hashid']] = $hash->read($v['hashid'],$mcache); 
$data[$v['id']]['img'] = conkeys($user_tmp[$v['hashid']],false);
$data[$v['id']]['con'] = conkeys($user_tmp[$v['hashid']]);
$data[$v['id']]['vs'] =turl($v['vs']);
$data[$v['id']]['sid'] = $v['sid'];
$data[$v['id']]['aid'] = $v['aid'];
 }
 }
return $data;
}
  
  
  
   
}
