<?php
namespace Model;
use YS\Model;
!defined('YS_PATH') && exit('YS_PATH not defined.');
class Qytree extends Model {
private $sqlme	= array('id', 'pid', 'name');

 public function readname($id,$mcache=false){
 if($id==0){return fy('未设置');}
 if($mcache==false){
return $this->find('name',array('id'=>$id));
}else{
$data=$mcache->get('qname'.$id);
if(empty($data)){
$data=$this->find('name',array('id'=>$id));
$mcache->set('qname'.$id,$data);
}
return $data;
 }
 }

public function read($id,$mcache=false,$size='*'){
if($mcache==false){
if($size=='*'){return $this->find('*',array('id'=>$id));}else{return $this->find($size,array('id'=>$id));}
}else{
$data=$mcache->get('Qy_'.$id);
if(empty($data)){$data=$this->find('*',array('id'=>$id));$mcache->set('Qy_'.$id,$data);}
if($size=='*'){return $data;}else{ if(isset($data[$size])) return $data[$size];}
  }
 return false; 
 
 }
public function getlist($pid,$mcache=false){
if($mcache==false){
$data=$this->select($this->sqlme,array("pid"=>$pid));
return $data;
}else{
$data=$mcache->get('qyl_'.$pid);
if(empty($data)){
$data=$this->select($this->sqlme,array("pid"=>$pid));
$mcache->set('qyl_'.$pid,$data);
}
 return $data;
 }}




}
