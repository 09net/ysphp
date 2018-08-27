<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Forum extends Model {
public function up_int($id,$key,$mcache=false){
if($mcache!=false) $mcache->rm(__CLASS__.$id);
return $this->update($key,array('id'=>$id));
}

 public function read($id,$mcache=false,$size=''){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$id)) return $data;
$data=$this->find('*',array('id'=>$id));
if($mcache!=false and $data) $mcache->set(__CLASS__.$id,$data);
if($size and isset($data[$size])) return  $data[$size];
return $data;

 }
public function read_name($name,$mcache=false,$size=''){
 if($mcache!=false) if($data=$mcache->get(__CLASS__.$name))  return $data;
$data=$this->find('*',array('name2'=>$name));
if($mcache!=false and $data) $mcache->set(__CLASS__.$name,$data);
if($size and isset($data[$size])) return  $data[$size];
return $data;

 }

public function up_so($thread_data,$mcache=false){
$getkey=M('Mykey')->get_key($thread_data['name'].' '.$thread_data['name2'],$mcache);
return $this->update(array('so' =>$getkey[0],'btime'=>NOW_TIME),array('id'=>$thread_data['id']));  
 } 


public function read_list($pageid , $listnum = 10,$fid = -1,$mcache=false){
$data = array('ORDER'=>'btime DESC','LIMIT' => array(0,$listnum));
if($pageid<1) $pageid=ceil(NOW_TIME/300)*300;

if($fid > 0){/*UID*/
$data['AND']=array('fid'=>$fid,'btime[<]'=>$pageid);
}else{/*多语言*/
$data['AND']=array('lang'=>NOW_LANG,'btime[<]'=>$pageid);
}

if($mcache!=false) $data2=$mcache->get('dorum'.$fid.'_'.NOW_LANG.$pageid);
if(empty($data2)){$data2=$this->select('*',$data);
if($mcache!=false and $data2) $mcache->set('dorum'.$fid.'_'.NOW_LANG.$pageid,$data2);}
return $data2;
 }
 

 

 public function search_list($pageid,$listnum,$key,$mcache=false){
if($mcache!=false) $data2=$mcache->get(md5('fls'.$pageid.$key[0]));
if(empty($data2)){$data2=$this->select('*',array('LIMIT'=>array($listnum*$pageid,$listnum),'MATCH'=>array('columns'=>array('so'),'keyword'=>$key[0])));
$this->format($data2,$mcache,$key[1]);
if($mcache!=false and $data2) $mcache->set(md5('fls'.$pageid.$key[0]),$data2);}
return $data2;
}


public function format(&$thread_list,$mcache=false,$key=false){
 if(empty($thread_list)) return false;
 if($key) {$k1=array();$k2=array();
 foreach ($key as  $value){$k1[]=$value;$k2[]='<b>'.$value.'</b>';}
 }
  foreach ($thread_list as &$v){
 if($key) $v['name']= str_ireplace($k1,$k2,$v['name']);
 }

 }




}