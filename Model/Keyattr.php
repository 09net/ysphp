<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Keyattr extends Model {

private $sqlme	=array('id','kid','xid','aid','sid','hashid','vs','uid','mode','files');
public function read_size($size,$id,$mcache=false){
$data=$this->read($id,$mcache);
if($data){return $data[$size];}else{return false;}
} 

public function read_hash($kid,$aid,$mcache=false){
if($mcache!=false) if($data=$mcache->get('r2_h_'.$kid.'_'.$aid)) return $data;
$k = explode(' ',$kid); 
foreach ($k as $kiditem){ 
if($hashid=$this->find('hashid',array('AND'=>array('kid'=>$kiditem,'aid'=>$aid)))){
$data=M('Hash')->read($hashid,$mcache); 
if($data) $mcache->set('r2_h_'.$kid.'_'.$aid,$data);
return $data;
}
} 
return false;
}


public function read($id,$mcache=false){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$id)) return $data;
if($data=$this->format_one($this->find($this->sqlme,array('id'=>$id)),$mcache) and $mcache!=false) $mcache->set(__CLASS__.$id,$data);
return $data;
 } 

public function format_one($v,$mcache=false){
 if(!is_array($v)) return $v;
 $User = M("User"); 
if($v['uid']<1) $v['uid']=1;
$tem=$User->read($v['uid'],$mcache);
$v['user'] = $tem['user'];
$v['avatar']=$tem['avatar'];
 return $v;
}

 public function up_int($id,$key,$mcache=false){
if($mcache!=false){$mcache->rm('Keyattr'.$id);}
return $this->update($key,array('id'=>$id));

 }
 public function del($id,$mcache=false){
 $this->delete(array('id'=>$id));
if($mcache!=false){$mcache->rm('thread_'.$id);}
 
 }

 
public function read_a($id,$mcache=false){
if($mcache==false){return $this->find($this->sqlme,array('aid'=>$id));
}else{
$data=$mcache->get('Keyattra'.$id);
if(empty($data)){$data=$this->find($this->sqlme,array('aid'=>$id));
$mcache->set('Keyattra'.$id,$data);}
return $data;
  }
 }
public function read_k($id,$mcache=false){
if($mcache==false){return $this->find($this->sqlme,array('kid'=>$id));
}else{
$data=$mcache->get('Keyattrk'.$id);
if(empty($data)){$data=$this->find($this->sqlme,array('kid'=>$id));
$mcache->set('Keyattrk'.$id,$data);}
return $data;
  }
 } 
 
public function resetxid($id,$mcache=false) {

$tx_a=array();
$sql=array();
$xid=$this->get_xid($id);
for ($x=0; $x<=$xid; $x++){
$tx=$this->find(array('id','hashid'),array("ORDER"=>'sid DESC','AND'=>array('kid'=>$id,'xid'=>$x,'aid'=>0)));
if(!$tx) continue;
if(in_array($tx['hashid'],$tx_a)){
$item=array_keys($tx_a,$tx['hashid']);
if($tx['id']) $this->del($tx['id']);/*删除特性*/
$this->update(array('xid'=>$item[0]),array('AND'=>array('kid'=>$id,'xid'=>$x)));
/*更新本xid*/
$sql[]=array('AND'=>array('kid'=>$id,'xid[>]'=>$x));
/*一起下移*/
}else{
$tx_a[$x]=$tx['hashid'];
}
}
foreach ($sql as $v) $this->update(array('xid[-]'=>1),$v);
}
 
 
 
public function gettx($id,$xid,$mcache=false){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10),'AND'=>array('kid'=>$id,'xid'=>$xid,'aid'=>0));
if($mcache==false){
return $this->format($this->select($this->sqlme,$data));
}else{
$data2=$mcache->get('gettx'.$id.'_'.$xid);
if(empty($data2)){$data2=$this->format($this->select($this->sqlme,$data));if($data2)$mcache->set('gettx'.$id.'_'.$xid,$data2);}
}
return $data2;
} 

public function getsize($id,$xid,$size,$mcache=false){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10),'AND'=>array('kid'=>$id,'xid'=>$xid));
if(!$data['AND']['aid']=$mcache->get('mk_s_l'.$size)) $data['AND']['aid']=M('Mykey')->getsize($size,$mcache);
if(!$data['AND']['aid']) return false;
if($mcache==false){
return $this->format($this->select($this->sqlme,$data));
}else{
$data2=$mcache->get('gettx'.$id.'_'.$xid);
if(empty($data2)){$data2=$this->format($this->select($this->sqlme,$data));if($data2)$mcache->set('gettx'.$id.'_'.$xid,$data2);}
}
return $data2;
} 


/*全面支持同义词，名称*/

public function read_a_list($id,$mcache=false,$sid=0){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10));

if($sid>0){
if(is_numeric($id)){$data['AND']=array('aid'=>$id,'sid[<]'=>$sid);}else{$data['AND']=array('aid'=>explode(' ',$id),'sid[<]'=>$sid);}
}else{
if(is_numeric($id)){$data['aid']=$id;}else{$data['aid']=explode(' ',$id);}
}

if($mcache==false){
return $this->format($this->select($this->sqlme,$data));
}else{
$data2=$mcache->get('Kal'.$sid.'_'.$id);
if(empty($data2)){$data2=$this->format($this->select($this->sqlme,$data));if($data2)$mcache->set('Kal'.$sid.'_'.$id,$data2);}
}

return $data2;
 } 
 
 
public function read_tx_list($id,$mcache=false,$sid=0){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10));
if($sid>0){
$data['AND']=array('hashid'=>$id,'aid'=>0,'sid[<]'=>$sid);
}else{
$data['AND']=array('hashid'=>$id,'aid'=>0);
}

if($mcache==false){
return $this->select(array('kid','xid','sid'),$data);
}else{
$data2=$mcache->get('Katx'.$sid.'_'.$id);
if(empty($data2)){$data2=$this->select(array('kid','xid','sid'),$data);if($data2) $mcache->set('Katx'.$sid.'_'.$id,$data2);}
}
return $data2;
 } 
 
 

public function read_k_list($id,$xid,$mcache=false,$sid=0){
$data=array("ORDER"=>'sid DESC',"LIMIT" => array(0,10));
if($sid==0)  $data['LIMIT']= array(0,30);
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
$data2=$mcache->get('Kakl'.$sid.'_'.$id.'_'.$xid);
if(empty($data2)){$data2=$this->format($this->select($this->sqlme,$data));if($data2)$mcache->set('Kakl'.$sid.'_'.$id.'_'.$xid,$data2);}
}
if(empty($data2) and $sid==0) M('Keyno')->up($id,$mcache);
return $data2;
 } 
/*全面支持同义词，名称属性*/
public function read_k_list2($id,$mcache=false,$sid=0){


if(is_numeric($id[0])){$id0=$id[0];}else{$id0=explode(' ',$id[0]);}
if(is_numeric($id[1])){$id1=$id[1];}else{$id1=explode(' ',$id[1]);}
$d3=array('AND'=>array('kid'=>$id0,'aid'=>$id1),"ORDER"=>'goods DESC',"LIMIT" => array(0,10));
if($sid>0) $d3['AND']['sid[<]']=$sid;

if($mcache==false){return $this->select($this->sqlme,$d3);
}else{
$data=$mcache->get('Kakl2_'.$sid.'_'.$id[0].$id[1]);
if(empty($data)){$data=$this->select($this->sqlme,$d3);
if($data) $mcache->set('Kakl2_'.$sid.'_'.$id[0].$id[1],$data);}
$data=$this->format($data);

if(empty($data)) M('Keyno')->up($id,$mcache);

return $data;
  }
 } 

 
 
 public function read_h($id,$mcache=false){
if($mcache==false){return $this->find($this->sqlme,array('hashid'=>$id));
}else{
$data=$mcache->get('Keyattrh'.$id);
if(empty($data)){$data=$this->find($this->sqlme,array('hashid'=>$id));
$mcache->set('Keyattrh'.$id,$data);}
return $data;
  }
 } 
public function get_xid($id){
$xid=$this->find('xid',array('kid'=>$id,"ORDER"=>'xid DESC'));
return $xid?$xid:0;
} 
public function get_xlist($id,$mcache=false){
if(empty($id))return '';
$xlist='';
if($mcache!=false) $xlist=$mcache->get('get_xlist'.$id);
if(empty($xlist)){
$xid=$this->get_xid($id);
for ($x=0; $x<=$xid; $x++){
if($x>20) break;
if($this->find('id',array('AND'=>array('kid'=>$id,'xid'=>$x)))){
$xlist.='<div class="col-xs-4 col-sm-3">'.M('Keyhtml',array($id,$x))->keyhtmlget($id,$x,'m',$mcache).'</div>';}
}
}
if($xlist) $mcache->set('get_xlist'.$id,$xlist);
return $xlist;


}
public function get_txlist($hashid,$mcache=false){
if(empty($hashid))return '';
$xlist='';
if($mcache!=false) $xlist=$mcache->get('get_txlist'.$hashid);
if(empty($xlist)){
if($data=$this->read_tx_list($hashid,$mcache))/*特性*/
foreach($data as $v) $xlist.='<div class="col-xs-4 col-sm-3">'.M('Keyhtml',array($v['kid'],$v['xid']))->keyhtmlget($v['kid'],$v['xid'],'m',$mcache).'</div>';

if($xlist) $mcache->set('get_txlist'.$hashid,$xlist);

}

return $xlist;


}

public function tongyici($a,$b,$mcache=false){
static $Mykey = false;
if($Mykey === false) $Mykey = M('Mykey');
$a=$Mykey->read($a,$mcache);
$b=$Mykey->read($b,$mcache);
return $a.'=><a href="/cdn/search/'.urlencode($b).'/0.html">'.$b.'</a>';
}


public function get_data($a,$mcache=false){
if(empty($a))return $a;
$data=array();
if($mcache!=false) $data=$mcache->get(md5('keydata2'.serialize($a)));

if(empty($data)){
$count=count($a);
if($count==1){
$key=array_keys($a);

$data[1]=$this->get_txlist(sha1($a[$key[0]]).strlen($a[$key[0]]),$mcache);/*特性*/
$data[2]=array();
$data[2][]=$this->read_h(sha1($a[$key[0]]).strlen($a[$key[0]]),$mcache);/*hashid*/

if(!is_numeric($key[0])){
$keya= explode(' ',$key[0]); 
$data[3][]=$this->tongyici($keya[0],$keya[1],$mcache);
$key[0]=$keya[1];
}
$data[0]=$this->get_xlist($key[0],$mcache);/*列表*/
$data[2][]=$this->read_a($key[0],$mcache);/*aid*/
$data[2]=$this->format($data[2]);
if(empty($data[0]) and empty($data[1]) and empty($data[2])) M('Keyno')->up($key[0],$mcache);
}elseif($count>1){
$key=array_keys($a);
$data[0]=array();
$data[1]=array();
$data[2]=$this->read_k_list2($key,$mcache);

}

if($mcache!=false and !empty($data)){
$mcache->set(md5('keydata2'.serialize($a)),$data);
}
}



  return $data;
   
 }
 
public function format($thread_list,$mcache=false){
 if(empty($thread_list)) return;
 static $user_tmp = array();
 static $wy_tmp = array();
  static $sanyaos = array();
 $User=M('Mykey');
 $hash=M('Hash');
 $data=array();
 foreach ($thread_list as $v){
 if(empty($v) or isset($data[$v['id']])){
 /*防止重复*/
 }else{
 /*wy重新格式化*/
if(isset($v['wy']) and $v['aid']>0){
$wy=sha1($v['kid'].$v['aid'].$v['hashid']).$v['kid'];
if($v['wy']!=$wy){
if(!$this->up_int($v['id'],array('wy'=>$wy))){$this->del($v['id']);continue;}
}
}



$data[$v['id']]=array();
if(empty($user_tmp[$v['kid']])) $user_tmp[$v['kid']] = $User->read($v['kid'],$mcache);
$data[$v['id']]['kname'] = $user_tmp[$v['kid']];
if(empty($user_tmp[$v['aid']])) $user_tmp[$v['aid']] = $User->read($v['aid'],$mcache);
$data[$v['id']]['aname'] = $user_tmp[$v['aid']];
if(empty($user_tmp[$v['hashid']])) $user_tmp[$v['hashid']] = $hash->read($v['hashid'],$mcache); 
$data[$v['id']]['img'] = conkeys($user_tmp[$v['hashid']],false);
$data[$v['id']]['con'] = conkeys($user_tmp[$v['hashid']]);
/*中文名删除*/
if($data[$v['id']]['kname']==$data[$v['id']]['con']){$this->del($v['id']);unset($data[$v['id']]);continue;}
/*拼音纠错*/
if($v['aid']=='14992' and preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data[$v['id']]['con'])){$this->del($v['id']);unset($data[$v['id']]);continue;}
$data[$v['id']]['vs'] =turl($v['vs']);
$data[$v['id']]['sid'] = $v['sid'];
$data[$v['id']]['files'] = $v['files'];
$data[$v['id']]['aid'] = $v['aid'];

/*重复属性处理*/
if(!empty($sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']])){
if($v['id']>$sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']]){/*重复处理*/
S('key_all')->insert($this->find('*',array('id'=>$sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']])));
 $this->delete(array('id'=>$sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']]));
unset($data[$sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']]]);continue;
}else{
S('key_all')->insert($this->find('*',array('id'=>$v['id'])));
 $this->delete(array('id'=>$v['id']));
unset($data[$v['id']]);continue;
}


}else{
$sanyaos[$v['kid'].'_'.$v['aid'].'_'.$v['xid']]=$v['id'];

}



 }
 }

return $data;
}
  
  
  
   
}
